<template>
	<form @submit.prevent="$parent.submitSeller">
	    <div class="form-group row justify-content-center">
	    	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
	    		<div class="input-group">
	    			<div class="input-group-prepend">
	          			<div class="input-group-text"><Octicon :icon="Octicons.ruby" /></div>
		        	</div>
	    		 	<input v-model="$parent.fields.name" class="form-control" type="text" placeholder="Name">
	    		</div>
	    	</div>
		
	    	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
	            <div class="input-group">
	    		 	<input v-model="$parent.fields.url" class="form-control" type="text" placeholder="URL">
	    		</div>
	        </div>
		</div>
		<div class="form-group row justify-content-center">
	    	<div class="col-12 col-sm-9 col-md-6 col-lg-4">
	    		<div class="input-group">
	    			<div class="input-group-prepend">
	          			<div class="input-group-text"><Octicon :icon="Octicons.milestone" /></div>
		        	</div>
	    		 	<input v-model="$parent.fields.street" class="form-control" type="text" placeholder="Street">
	    		</div>
	    	</div>
		
	    	<div class="col-12 col-sm-3 col-md-2 col-lg-2">
	            <div class="input-group">
	    		 	<input v-model="$parent.fields.postalCode" class="form-control" type="text" placeholder="Postal code">
	    		</div>
	        </div>
		</div>
		<div class="form-group row justify-content-center">
	    	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
	    		<div class="input-group">
		            <div class="input-group-prepend">
	          			<div class="input-group-text"><Octicon :icon="Octicons.pin" /></div>
	        		</div>
		            <select v-model="$parent.fields.city" v-on:keypress="$parent.searchInSelect('city')" class="custom-select" id="selectUser">
		                <option value="" disabled selected hidden>City...</option>
		                <option v-for="city in $parent.cities" v-bind:value="city.value">
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
		            <select v-model="$parent.fields.country" class="custom-select" id="selectSellers">
		                <option value="" disabled selected hidden>Country...</option>
		                <option v-for="country in $parent.countries" v-bind:value="country.value">
		                    {{ country.text }}
		                </option>
		            </select>
		            <!-- <v-select :options="$parent.countries" :pushTags="true"></v-select> -->
	        	</div>
	        </div>
		</div>
		<div class="form-group row justify-content-center">
			<div class="col-12 col-sm-6 col-md-4 col-lg-3">
	    		<button v-on:click="$parent.flipForm" class="btn btn-secondary" type="button"><center>Cancel</center></button>	
	    	</div>
	    	<div class="col-12 col-sm-6 col-md-4 col-lg-3">
	    		<button class="btn btn-success" type="submit"><center>Submit seller</center></button>	
	    	</div>
		</div>
	</form>
</template>

<script>
	const { Octicon, Octicons } = require('octicons-vue')

	export default 
    {	
      	data() 
        {
			return(
			{
                Octicons: Octicons,
            });
        },

        components: {
  			Octicon: Octicon,
  		}
    }
</script>
