<script>

import { Line } from 'vue-chartjs';
import 'chartjs-plugin-colorschemes/src/plugins/plugin.colorschemes';
import { SetTwo8 } from 'chartjs-plugin-colorschemes/src/colorschemes/colorschemes.brewer';

function makeRequest(url)
{
    return new Promise(function (resolve, reject)
    {
        axios.get(url).then(function (response) 
        {
            // handle success
            resolve(response.data);
        })
        .catch(function (error) 
        {
            // handle error
            reject(error);
        });
    });
}

export default 
{
    extends: Line,
    async mounted() 
    {
        let uriData = 'http://127.0.0.1:8000/getData';
        let uriUsers = 'http://127.0.0.1:8000/getUsers';

        let Users = [];

        let total = 0;

        let data = await makeRequest(uriData);
    
        let Total = {};
        Total["name"] = "Total";
        Total["purchase"] = [];


        for (var i = 0; i < data.length; i++)
        {
            let row = data[i];
            
            let sameDate = -1;

            total += row.amount;

            if(i<data.length-1)
            {
                let d1 = Date.parse(data[i].date);
                let d2 = Date.parse(data[i+1].date);

                if(d1 == d2)
                {
                    sameDate = 0;
                }
            }

            if(sameDate != 0)
            {
                let purchase = {};
                purchase.x = data[i].date;
                purchase.y = total
                Total["purchase"].push(purchase)
            }
        }

        Users.push(Total)

        let users = await makeRequest(uriUsers);

        for (var i = 0; i < users.length; i++)
        {
            let user = users[i]

            let uriDataUser = uriData+'/'+user.id;

            let User = {};
            User["name"] = user.name;
            User["purchase"] = [];

            let usersData = await makeRequest(uriDataUser);

            let k=0;
            let total = 0;

            for (var j = 0; j < usersData.length; j++)
            {
                let sameDate = -1;

                total += usersData[j].amount;

                if(j<usersData.length-1)
                {
                    let d1 = Date.parse(usersData[j].date);
                    let d2 = Date.parse(usersData[j+1].date);

                    if(d1 == d2)
                    {
                        sameDate = 0;
                    }
                }

                if(sameDate != 0)
                {
                    let purchase = {};
                    purchase.x = usersData[j].date;
                    purchase.y = total
                    User["purchase"].push(purchase);
                }
            }

            Users.push(User);
        }
        
        let lineChart =  
        {
            datasets: []
        };

        let lineChartOptions = 
        {
            scales: {
                xAxes: [{
                    type: 'time',
                    time: {
                        unit: 'month'
                    }
                }]
            },
            plugins: 
            {
                colorschemes: 
                {
                    scheme: SetTwo8
                }
            },
            responsive: true, 
            maintainAspectRatio: false
        };
     
        for (var UserId in Users) 
        {
            let User = Users[UserId]
            console.log(User)
            lineChart.datasets.push(
            {
                label: User.name,
                lineTension : 0,
                fill: false,
                data: User.purchase
            });
        }

        this.renderChart(lineChart, lineChartOptions);
    }
}

</script>
