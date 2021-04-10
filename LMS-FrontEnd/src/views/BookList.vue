<template>
  <div>
    <AppBar />
    <!-- <div v-for=" item in items  :key="index""> -->
  
      <div class="row" >
        <div class="col-lg-3">
          <SingleBook />
        </div>
        <div class="col-lg-3">
          <SingleBook />
        </div>
        <div class="col-lg-3">
          <SingleBook />
        </div>
        <div class="col-lg-3">
          <SingleBook />
        </div>
        <div class="col-lg-3">
          <SingleBook />
        </div>
        <div class="col-lg-3">
          <SingleBook />
        </div>
        <div class="col-lg-3">
          <SingleBook />
        </div>
        <div class="col-lg-3">
          <SingleBook />
        </div>
        <div class="col-lg-3">
          <SingleBook />
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
      items: [
        { no: "1" },
        { no: "1" },
        { no: "1" },
        { no: "1" },
        { no: "1" },
        { no: "1" },
        { no: "1" },
        { no: "1" },
        { no: "1" }
      ]
    };
  }
};
</script>
