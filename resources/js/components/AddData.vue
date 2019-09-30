<template>
		<form>
	        <div class="form-group row justify-content-center">
	        	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
	        		<div class="input-group">
			            <div class="input-group-prepend">
		          			<div class="input-group-text"><Octicon :icon="Octicons.person" /></div>
		        		</div>
			            <select class="custom-select" id="selectUser">
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
			            <select class="custom-select" id="selectSellers" name="test">
			                <option value="" disabled selected hidden>Seller...</option>
			                <option v-for="seller in sellers" v-bind:value="seller.value">
			                    {{ seller.text }}
			                </option>
			            </select>
		        	</div>
		        </div>
        	</div>
   
   			<div class="form-group row justify-content-center">
	        	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
	        		<div class="input-group">
	        			<div class="input-group-prepend">
		          			<div class="input-group-text"><Octicon :icon="Octicons.calendar" /></div>
			        	</div>
	        			<input class="form-control" type="date" id="datepicker" placeholder="Date...">
	        		</div>
	        	</div>
	        	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
	        		<div class="input-group">
	        			<div class="input-group-prepend">
		          			<div class="input-group-text">$</div>
			        	</div>
	        		 	<input class="form-control" type="number" min="0" placeholder="Amount...">
	        		</div>
	        	</div>
        	</div>

        	<div class="form-group row justify-content-center">
	        	<div class="col-sm-12 col-md-8 col-lg-6">
	        		<div class="input-group">
	        			<div class="input-group-prepend">
		          			<div class="input-group-text"><Octicon :icon="Octicons.tag" /></div>
			        	</div>
	        		 	<input type="text" class="form-control" id="inlineFormInputName2" placeholder="Desciption (optional)">
	        		</div>
	        	</div>
        	</div>

        	<div class="form-group row justify-content-center">
        		<div class="col-12 col-sm-6 col-md-4 col-lg-3">
	        		<div class="input-group custom-control custom-checkbox">
	        			<input type="checkbox" class="custom-control-input" id="customCheck1">
	  					<label class="custom-control-label" for="customCheck1">Share</label>
	        		</div>
	        	</div>
	        	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
	        		<button class="btn btn-primary" type="submit"><center>Submit purchase</center></button>	
	        	</div>

        	</div>
	        
	    </form>
</template>

<script>
    
	//import Datepicker from 'vuejs-datepicker';

   	//$( "#datepicker" ).datepicker();

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

    let Users = [];
	let Sellers = [];

	const { Octicon, Octicons } = require('octicons-vue')

    export default 
    {
      	async mounted()
      	{
      		let usersData = await makeRequest('http://127.0.0.1:8000/getUsers');
		    let sellersData = await makeRequest('http://127.0.0.1:8000/getSellers');

		    for (var i = 0; i < usersData.length; i++)
		    {
		        let user = {};
		        user["text"] = usersData[i].name;
		        user["value"] = usersData[i].id;
		        Users.push(user);
		    }

		    for (var i = 0; i < sellersData.length; i++)
		    {
		        let seller = {};
		        seller["text"] = sellersData[i].name;
		        seller["value"] = sellersData[i].id;
		        Sellers.push(seller);
		    }
		},

      	data() 
        {
			return(
			{
                Octicons: Octicons,
                users: Users,
                sellers: Sellers
            });
        },

        components: {
  			//Datepicker,
  			Octicon
  		}
    }
    	
</script>