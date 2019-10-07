<template>
	<div class="container">
		<purchase :key="componentKey"></purchase>
		<div class="flip-card">
			<div class="flip-card-inner" id="flip-card-inner">
				<div class="flip-card-front" id="flip-card-front">
					<form @submit.prevent="submitPurchase">
				        <div class="form-group row justify-content-center">
				        	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				        		<div class="input-group">
						            <div class="input-group-prepend">
					          			<div class="input-group-text"><Octicon :icon="Octicons.person" /></div>
					        		</div>
						            <select v-model="fields.user" class="custom-select" id="selectUser">
						                <option value="" disabled selected hidden>User...</option>
						                <option v-for="user in users" v-bind:value="user.value">
						                    {{ user.text }}
						                </option>
						            </select>
					        	</div>
				        	</div>
			        	
				        	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					            <div class="input-group">
						            <div class="input-group-prepend">
					          			<div class="input-group-text"><Octicon :icon="Octicons.ruby" /></div>
						        	</div>
						            <select v-model="fields.seller" class="custom-select" id="selectSellers">
						                <option value="" disabled selected hidden>Seller...</option>
						                <option v-for="seller in sellers" v-bind:value="seller.value">
						                    {{ seller.text }}
						                </option>
						            </select>
						            <div class="input-group-append">
					          			<button class="btn btn-outline-success" type="button" v-on:click="flipForm"><Octicon :icon="Octicons.plus" /></button>
						        	</div>
					        	</div>
					        </div>
			        	</div>
			   
			   			<div class="form-group row justify-content-center">
				        	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				        		<div class="input-group">
				        			<div class="input-group-prepend">
					          			<div class="input-group-text"><Octicon :icon="Octicons.calendar" /></div>
						        	</div>
				        			<input v-model="fields.date" class="form-control" type="date" id="datepicker" placeholder="Date...">
				        		</div>
				        	</div>
				        	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				        		<div class="input-group">
				        			<div class="input-group-prepend">
					          			<div class="input-group-text">$</div>
						        	</div>
				        		 	<input v-model="fields.amount" class="form-control" type="number" min="0" step="0.01" placeholder="Amount...">
				        		</div>
				        	</div>
			        	</div>

			        	<div class="form-group row justify-content-center">
				        	<div class="col-sm-12 col-md-8 col-lg-6">
				        		<div class="input-group">
				        			<div class="input-group-prepend">
					          			<div class="input-group-text"><Octicon :icon="Octicons.tag" /></div>
						        	</div>
				        		 	<input v-model="fields.description" type="text" class="form-control" id="inlineFormInputName2" placeholder="Desciption (optional)">
				        		</div>
				        	</div>
			        	</div>

			        	<div class="form-group row justify-content-center">
			        		<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				        		<div class="input-group custom-control custom-checkbox">
				        			<input v-model="fields.share" type="checkbox" class="custom-control-input" id="customCheck1">
				  					<label class="custom-control-label" for="customCheck1">Share</label>
				        		</div>
				        	</div>
				        	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				        		<button class="btn btn-primary" type="submit"><center>Submit purchase</center></button>	
				        	</div>

			        	</div>
				        
				    </form>
				</div>
				<div class="flip-card-back" id="flip-card-back">
			      <form @submit.prevent="submitSeller">
				        <div class="form-group row justify-content-center">
				        	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				        		<div class="input-group">
				        			<div class="input-group-prepend">
					          			<div class="input-group-text"><Octicon :icon="Octicons.ruby" /></div>
						        	</div>
				        		 	<input v-model="fields.name" class="form-control" type="text" placeholder="Name">
				        		</div>
				        	</div>
			        	
				        	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					            <div class="input-group">
				        		 	<input v-model="fields.url" class="form-control" type="text" placeholder="URL">
				        		</div>
					        </div>
			        	</div>
			        	<div class="form-group row justify-content-center">
				        	<div class="col-12 col-sm-9 col-md-6 col-lg-4">
				        		<div class="input-group">
				        			<div class="input-group-prepend">
					          			<div class="input-group-text"><Octicon :icon="Octicons.milestone" /></div>
						        	</div>
				        		 	<input v-model="fields.street" class="form-control" type="text" placeholder="Street">
				        		</div>
				        	</div>
			        	
				        	<div class="col-12 col-sm-3 col-md-2 col-lg-2">
					            <div class="input-group">
				        		 	<input v-model="fields.postalCode" class="form-control" type="text" placeholder="Postal code">
				        		</div>
					        </div>
			        	</div>
			        	<div class="form-group row justify-content-center">
				        	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				        		<div class="input-group">
						            <div class="input-group-prepend">
					          			<div class="input-group-text"><Octicon :icon="Octicons.pin" /></div>
					        		</div>
						            <select v-model="fields.city" class="custom-select" id="selectUser">
						                <option value="" disabled selected hidden>City...</option>
						                <option v-for="city in cities" v-bind:value="city.value">
						                    {{ city.text }}
						                </option>
						            </select>
					        	</div>
				        	</div>
			        	
				        	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
					            <div class="input-group">
						            <div class="input-group-prepend">
					          			<div class="input-group-text"><Octicon :icon="Octicons.globe" /></div>
						        	</div>
						            <select v-model="fields.country" class="custom-select" id="selectSellers">
						                <option value="" disabled selected hidden>Country...</option>
						                <option v-for="country in countries" v-bind:value="country.value">
						                    {{ country.text }}
						                </option>
						            </select>
					        	</div>
					        </div>
			        	</div>
			        	<div class="form-group row justify-content-center">
		        			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				        		<button v-on:click="flipForm" class="btn btn-secondary" type="button"><center>Cancel</center></button>	
				        	</div>
				        	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
				        		<button class="btn btn-success" type="submit"><center>Submit seller</center></button>	
				        	</div>
		        		</div>
				    </form>
			    </div>
			</div>
		</div>
	</div>
</template>

<script>
    
	//import Datepicker from 'vuejs-datepicker';

   	//$( "#datepicker" ).datepicker();
   	import purchase from './Purchase'

    function sleep(ms) 
    {
	  return new Promise(resolve => setTimeout(resolve, ms));
	}

	function jsonToOptions(json, list)
	{
		let data = json;

        for (var i = 0; i < data.length; i++)
	    {
	        let elm = {};
	        elm["text"] = data[i].name;
	        elm["value"] = data[i].id;
	        list.push(elm);
	    }	
	}

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

	let componentKey = 0;
	const { Octicon, Octicons } = require('octicons-vue')

	let Users = [];
	let Sellers = [];
	let Cities = [];
	let Countries = [];

    export default 
    {
      	async mounted()
      	{
      		let UsersData = await makeRequest('http://127.0.0.1:8000/getUsers');
		    let SellersData = await makeRequest('http://127.0.0.1:8000/getSellers');
		    let CitiesData = await makeRequest('http://127.0.0.1:8000/getCities');
		    let CountriesData = await makeRequest('http://127.0.0.1:8000/getCountries');

		    jsonToOptions(UsersData, Users);
		    jsonToOptions(SellersData, Sellers);
		    jsonToOptions(CitiesData, Cities);
		    jsonToOptions(CountriesData, Countries);
		},

      	data() 
        {
			return(
			{
                Octicons: Octicons,
                users: Users,
                sellers: Sellers,
                cities: Cities,
                countries: Countries,
                fields: {},
      			errors: {},
      			componentKey
            });
        },

        components: {
  			//Datepicker,
  			Octicon,
  			purchase
  		},

  		methods: {
		    forceRerender() {
      			this.componentKey += 1;  
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
		    submitPurchase() {
		      this.errors = {};
		      axios.post('http://127.0.0.1:8000/submitPurchase', this.fields).then(response => {
		        //alert('Message sent!');
		        this.forceRerender();
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
			        this.forceRerender();
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