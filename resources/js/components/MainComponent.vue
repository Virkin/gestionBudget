<template>
	<div class="container">
		<purchasechart :key="chartComponentKey"></purchasechart>
		<div class="flip-card">
			<div class="flip-card-inner" id="flip-card-inner">
				<div class="flip-card-front" id="flip-card-front">
					<purchaseform :key="formComponentKey"></purchaseform>
				</div>
				<div class="flip-card-back" id="flip-card-back">
			    	<sellerform></sellerform>
			    </div>
			</div>
		</div>
	</div>
</template>

<script>
    
	//import Datepicker from 'vuejs-datepicker';

   	//$( "#datepicker" ).datepicker();
   	import purchasechart from './PurchaseChart'
   	import purchaseform from './PurchaseForm'
   	import sellerform from './SellerForm'

    function sleep(ms) 
    {
	  return new Promise(resolve => setTimeout(resolve, ms));
	}

	let chartComponentKey = 0;
	let formComponentKey = 0;

	let Users = [];
	let Cities = [];
	let Countries = [];

    export default 
    {
      	async mounted()
      	{
      		let UsersData = await this.makeRequest('http://127.0.0.1:8000/getUsers');
		    let CitiesData = await this.makeRequest('http://127.0.0.1:8000/getCities');
		    let CountriesData = await this.makeRequest('http://127.0.0.1:8000/getCountries');

		    this.jsonToOptions(UsersData, Users);
		    this.jsonToOptions(CitiesData, Cities);
		    this.jsonToOptions(CountriesData, Countries);
		},

      	data() 
        {
			return(
			{
                users: Users,
                cities: Cities,
                countries: Countries,
                fields: {},
      			errors: {},
      			chartComponentKey,
      			formComponentKey
            });
        },

        components: {
  			purchasechart,
  			purchaseform,
  			sellerform
  		},

  		methods: {
		    jsonToOptions(json, list)
			{
				let data = json;
				let contains;

		        for (var i = 0; i < data.length; i++)
			    {
			    	contains = false;
			        for(var j =0; j< list.length; j++)
			        {
			        	if(list[j].text == data[i].name)
			        	{
			        		contains = true;
			        	}
			        }

			        if(!contains)
			        {
			        	let elm = {};
				        elm["text"] = data[i].name;
				        elm["value"] = data[i].id;
				        list.push(elm);
			        }
			    }	
			},
			async makeRequest(url)
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
			},
		    forceChartRerender() {
      			this.chartComponentKey += 1;  
    		},
    		forceFormRerender() {
      			this.formComponentKey += 1;  
    		},
    		async flipForm(){

    			if(document.getElementById("flip-card-front").style.visibility == "hidden")
    			{
    				document.getElementById("flip-card-inner").style.transform = "none";

    				await sleep(400)

    				document.getElementById("flip-card-front").style.visibility = "visible"
    			} 
    			else
    			{
    				document.getElementById("flip-card-inner").style.transform = "rotateY(180deg)";

    				await sleep(400)
    				
    				document.getElementById("flip-card-front").style.visibility = "hidden"
				}
    		},
    		searchInSelect(selectName) {
    			console.log(selectName);
    		},
		    submitPurchase() {
		      this.errors = {};
		      axios.post('http://127.0.0.1:8000/submitPurchase', this.fields).then(response => {
		        //alert('Message sent!');
		        this.forceChartRerender();
		      }).catch(error => {
		        if (error.response.status === 422) {
		          this.errors = error.response.data.errors || {};
		        }
		        console.log(error);
		      });
		    },
		    submitSeller() {
		    	this.errors = {};
			      axios.post('http://127.0.0.1:8000/submitSeller', this.fields).then(response => {
			        //alert('Message sent!');
			        this.forceFormRerender();
			        this.flipForm()
			      }).catch(error => {
			        if (error.response.status === 422) {
			          this.errors = error.response.data.errors || {};
			        }
			        console.log(error);
			      });
			    }
		    },
    }
    	
</script>