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

        let Time = new Array();
        let Labels = new Array();
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
                Time.push(row.date);
                Total["purchase"].push(total)
            }

            Labels.push(row.id);
            
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
                let sameDate = usersData[j].date.localeCompare(data[k].date);
                let sameDateUser = -1;

                if(j<usersData.length-1)
                {
                    let d1 = Date.parse(usersData[j].date);
                    let d2 = Date.parse(usersData[j+1].date);

                    if(d1 == d2)
                    {
                        sameDateUser = 0;
                    }
                }

                console.log(sameDateUser);

                if(sameDate == 0)
                {
                    total += usersData[j].amount;
                }

                console.log(total);

                if(sameDateUser != 0 || sameDate != 0)
                {
                    User["purchase"].push(total);
                    console.log("push");
                }
                
                if(k<data.length)
                {
                    k++;
                }

                if((sameDate != 0 || j==usersData.length-1) && k<data.length)
                {
                    j--;
                }
            }

            Users.push(User);
        }
        
        let lineChart =  
        {
            labels: Time,
            datasets: []
        };

        let lineChartOptions = 
        {
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
