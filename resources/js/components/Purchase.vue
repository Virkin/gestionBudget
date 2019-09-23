<!--<script>
  //Importing Line class from the vue-chartjs wrapper
  import { Line } from 'vue-chartjs'

  //Exporting this so it can be used in other components
  export default {
    extends: Line,
    data () {
      return {
        datas: {
          //Data to be represented on x-axis
          labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          datasets: [
            {
              label: 'Data One',
              //Data to be represented on y-axis
              backgroundColor : ['rgba(47, 152, 208, 0.2)'],
              borderColor: ['rgba(19, 147, 228,1)'],
              lineTension: 0,
              data: [40, 20, 30, 50, 90, 10, 20, 40, 50, 70, 90, 100]
            },{
              label: 'Data two',
              //Data to be represented on y-axis
              backgroundColor : ['rgba(207, 62, 28, 0.2)'],
              borderColor: ['rgba(219, 47, 28,1)'],
              lineTension: 0,
              data: [40, 6, 30, 56, 90, 67, 20, 40, 50, 70, 90, 10]
            }
          ]
        },
        //Chart.js options that controls the appearance of the chart
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              },
              gridLines: {
                display: true
              }
            }],
            xAxes: [ {
              gridLines: {
                display: false
              }
            }]
          },
          legend: {
            display: true
          },
          responsive: true,
          maintainAspectRatio: false
        }
      }
    },
    mounted () {
      //renderChart function renders the chart with the datacollection and options object.
      this.renderChart(this.datas, this.options)
    }
  }
</script>-->

<script>
import { Line } from 'vue-chartjs';

export default {
   extends: Line,
   mounted() {
         let uri = 'http://localhost:8000/getData';
         let Time = new Array();
         let Labels = new Array();
         let Amount = new Array();
         this.axios.get(uri).then((response) => {
            let data = response.data;
            if(data) {
               data.forEach(element => {
               Time.push(element.date);
               Labels.push(element.id);
               Amount.push(element.amount);
               });
               this.renderChart({
               labels: Time,
               datasets: [{
                  label: 'Purchase',
                  backgroundColor: '#FC2525',
                  data: Amount
            }]
         }, {responsive: true, maintainAspectRatio: false})
       }
       else {
          console.log('No data');
       }
      });            
   }
}
</script>
