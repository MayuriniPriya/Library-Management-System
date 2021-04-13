<template>
  <div>
    <AppBar />
    <!-- <div v-for=" item in items  :key="index""> -->

    <div class="row">
      <div class="col-lg-3" v-for="item in BooksData" :key="item">
        <SingleBook :SingleData="item" />
      </div>
    </div>
    <div style="text-align: center;">
     <ul>
       <li>

 <a
            v-if="pagination.current_page != 1"
            class="listview1"
            @click="previous"
            >Previous</a
          >
          <a class="listview">{{ pagination.current_page }}</a>

          <a v-if="links.next" class="listview2" @click="nextpage">Next</a>
       </li>
      

     </ul>
      
        
      
    </div>
    <!-- </div> -->
  </div>
</template>
<script>
import AppBar from "../components/AppBar";
import SingleBook from "../components/Book";
export default {
  components: {
    SingleBook,
    AppBar
  },
  data() {
    return {
      BooksData: [],
      pagination: [],
      links: []
    };
  },
  methods: {
    nextpage() {
      debugger;
      const axios = require("axios");
      axios
        .get(this.links.next)
        .then(response => {
          // handle success
          this.BooksData = response.data.data;
          this.pagination = response.data.meta;
          this.links = response.data.links;

          console.log(response);
        })
        .catch(error => {
          // handle error
          console.log(error);
        });
    },
    previous() {
      const axios = require("axios");
      axios
        .get(this.links.prev)
        .then(response => {
          // handle success
          this.BooksData = response.data.data;
          this.pagination = response.data.meta;
          this.links = response.data.links;

          console.log(response);
        })
        .catch(error => {
          // handle error
          console.log(error);
        });
    },
    GetBookListData() {
      const axios = require("axios");
      axios
        .get(" http://localhost:8000/api/books")
        .then(response => {
          // handle success
          this.BooksData = response.data.data;
          this.pagination = response.data.meta;
          this.links = response.data.links;
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
<style>
.pagination {
  width: 400px;
  height: 100px;
}
.listview {
  background: aqua;
  width: 90px !important;
  color: white;
  height: 20px !important;
  border-radius: 50px;

  padding-left: 10px;
  top: 11px;
}
.listview1 {
  background: rgb(68, 231, 68);
 width: 90px  !important;
  height: 35px !important;
  border-radius: 50px;

  padding-left: 10px;
  top: 11px;
}
.listview2 {
  background: rgb(70, 11, 117);
  width: 90px  !important;
  height: 35px !important;
  border-radius: 50px;
  color: white;

  padding-left: 10px;
  top: 11px;
}

</style>
