<template>
  <div>
    <AppBar />
    <!-- <div v-for=" item in items  :key="index""> -->
  
      <div class="row" >
        <div class="col-lg-3" v-for="item in BooksData" :key="item">
          <SingleBook :SingleData="item" />
        </div>
        
      </div>
  
    <!-- </div> -->
  </div>
</template>
<script>
import AppBar from "../components/AppBar"
import SingleBook from "../components/Book";
export default {
  components: {
    SingleBook,AppBar
    
  },
 data() {
    return {
      BooksData: []
    };
  },
    methods: {
    GetBookListData() {
      const axios = require("axios");
      axios
        .get(" http://localhost:8000/api/books")
        .then(response => {
          // handle success
          this.BooksData = response.data.data;
          console.log(response);
        })
        .catch(error => {
          // handle error
          console.log(error);
        });
    }
  },
   created() {
    this.GetBookListData();
  }
};
</script>
