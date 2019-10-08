<template>
	<form @submit.prevent="$parent.submitPurchase">
	    <div class="form-group row justify-content-center">
	    	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
	    		<div class="input-group">
		            <div class="input-group-prepend">
	          			<div class="input-group-text"><Octicon :icon="Octicons.person" /></div>
	        		</div>
		            <select v-model="$parent.fields.user" class="custom-select" id="selectUser">
		                <option value="" disabled selected hidden>User...</option>
		                <option v-for="user in $parent.users" v-bind:value="user.value">
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
		            <select v-model="$parent.fields.seller" class="custom-select" id="selectSellers">
		                <option value="" disabled selected hidden>Seller...</option>
		                <option v-for="seller in sellers" v-bind:value="seller.value">
		                    {{ seller.text }}
		                </option>
		            </select>
		            <div class="input-group-append">
	          			<button class="btn btn-outline-success" type="button" v-on:click="$parent.flipForm"><Octicon :icon="Octicons.plus" /></button>
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
	    			<input v-model="$parent.fields.date" class="form-control" type="date" id="datepicker" placeholder="Date...">
	    		</div>
	    	</div>
	    	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
	    		<div class="input-group">
	    			<div class="input-group-prepend">
	          			<div class="input-group-text">$</div>
		        	</div>
	    		 	<input v-model="$parent.fields.amount" class="form-control" type="number" min="0" step="0.01" placeholder="Amount...">
	    		</div>
	    	</div>
		</div>

		<div class="form-group row justify-content-center">
	    	<div class="col-sm-12 col-md-8 col-lg-6">
	    		<div class="input-group">
	    			<div class="input-group-prepend">
	          			<div class="input-group-text"><Octicon :icon="Octicons.tag" /></div>
		        	</div>
	    		 	<input v-model="$parent.fields.description" type="text" class="form-control" id="inlineFormInputName2" placeholder="Desciption (optional)">
	    		</div>
	    	</div>
		</div>

		<div class="form-group row justify-content-center">
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
	    		<div class="input-group custom-control custom-checkbox">
	    			<input v-model="$parent.fields.share" type="checkbox" class="custom-control-input" id="customCheck1">
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
	const { Octicon, Octicons } = require('octicons-vue')

	let Sellers = []

	export default 
    {	
      	async mounted()
      	{
      		
		    let SellersData = await this.$parent.makeRequest('http://127.0.0.1:8000/getSellers');
		    
		    this.$parent.jsonToOptions(SellersData, Sellers);
		},

      	data() 
        {
			return(
			{
                Octicons: Octicons,
                sellers: Sellers,
            });
        },

        components: {
  			Octicon: Octicon,
  		}
    }
</script>


