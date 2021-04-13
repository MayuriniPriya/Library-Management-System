<template>
  <div>
    <AppBar />
    <!-- <div v-for=" item in items  :key="index""> -->

    <div class="row">
      <div class="col-lg-3" v-for="item in BooksData" :key="item">
        <SingleBook :SingleData="item" />
      </div>
    </div>
    <!-- <div style="text-align: center;">
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
      
        
      
    </div> -->
    <!-- </div> -->

    <div class="demo">
      <nav class="pagination-outer" aria-label="Page navigation">
        <ul class="pagination">
          <li class="page-item">
            <a
              href="#"
              class="page-link"
              aria-label="Previous"
              v-if="pagination.current_page != 1"
              @click="previous"
            >
              <span aria-hidden="true">«</span>
            </a>
          </li>

          <li class="page-item active">
            <a class="page-link" href="#">{{ pagination.current_page }}</a>
          </li>

          <li class="page-item">
            <a href="#" class="page-link" aria-label="Next"  v-if="links.next" @click="nextpage">
              <span aria-hidden="true">»</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
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
ul,
li {
  list-style-type: none;
}
.pagination-outer {
  text-align: center;
}
.pagination {
  font-family: "Itim", cursive;
  border-radius: 10px 10px 0 0;
  border-top: 10px solid #ff9f1a;
  display: inline-flex;
}
.pagination li {
  padding: 5px 0;
  margin: 0 5px;
}
.pagination li a.page-link {
  color: #fff;
  background: transparent;
  font-size: 21px;
  font-weight: 500;
  line-height: 30px;
  height: 33px;
  width: 43px;
  padding: 0;
  margin: 0;
  border: 1px solid #ff9f1a;
  border-radius: 0;
  display: block;
  transition: all 0.3s ease 0s;
}
.pagination li.active a.page-link,
.pagination li a.page-link:hover,
.pagination li.active a.page-link:hover,
.pagination li a.page-link:focus {
  color: #fff;
  background: #ff9f1a;
  line-height: 38px;
  height: 41px;
  margin: -5px 0 -3px;
  border: 1px solid #ff9f1a;
}
@media only screen and (max-width: 480px) {
  .pagination {
    font-size: 0;
    display: block;
  }
  .pagination li {
    display: inline-block;
  }
}
</style>
