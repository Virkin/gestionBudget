<script>

import { Line } from 'vue-chartjs';

function makeRequest(method, url)
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

        let data = await makeRequest("GET",uriData);
    
        let Total = {};
        Total["name"] = "Total";
        Total["purchase"] = [];


        for (var i = 0; i < data.length; i++)
        {
            let row = data[i];
            
            Time.push(row.date);
            Labels.push(row.id);

            total += row.amount;

            Total["purchase"].push(total) 
        }

        Users.push(Total)

        let users = await makeRequest("GET", uriUsers);

        for (var i = 0; i < users.length; i++)
        {
            let user = users[i]

            let uriDataUser = uriData+'/'+user.id;

            let User = {};
            User["name"] = user.name;
            User["purchase"] = [];

            let usersData = await makeRequest("GET", uriDataUser);

            let k=0;
            let total = 0;

            for (var j = 0; j < usersData.length; j++)
            {
                let sameDate = usersData[j].date.localeCompare(data[k].date);

                if(sameDate == 0)
                {
                    total += usersData[j].amount;
                }
              
                User["purchase"].push(total);
                
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

        let lineChartOptions = {responsive: true, maintainAspectRatio: false};

        console.log(Time);
     
        for (var UserId in Users) 
        {
            let User = Users[UserId]
            lineChart.datasets.push(
            {
                label: User.name,
                fillColor: 'rgba(220,220,220,0.2)',
                strokeColor: 'rgba(220,220,220,1)',
                pointColor: 'rgba(220,220,220,1)',
                pointStrokeColor: '#fff',
                pointHighlightFill: '#fff',
                pointHighlightStroke:
                'rgba(220,220,220,1)',
                lineTension : 0,
                data: User.purchase
            });
        }

        this.renderChart(lineChart, lineChartOptions);
    }
}

</script>
