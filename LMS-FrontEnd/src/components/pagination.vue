<template>
  <ul class="pagination">
    <!-- {{Pagination.current_page}} -->
      <a  class="listview">{{ Pagination.current_page }}</a>

    <li>
      <a href="#" v-if="Pagination.current_page !=1" class="listview1" @click="Previous">Previous</a>
      <a href="#" class="listview2" @click="nextpage">Next</a>
    </li>
  </ul>
</template>
<script>
export default {
  props: {
    Pagination: [String, Number],
    LINKS: [String, Number]
  },
  Pagination: {
    type: Array,
    default: ""
  },
  LINKS: {
    type: Array,
    default: ""
  },
  components: {},
  data() {
    return {
      current_page: ""
    };
  },
  methods: {},
  nextpage() {
    this.$emit("NextPage", this.LINKS.next);
  },
  Previous() {
    this.$emit("PreviousPage", this.LINKS.prev);
  }
};
</script>

<style scoped>
.pagination {
  width: 350px;
}
.listview {
  background: aqua;
    width: 61px;
    height: 20px;
    padding-top: 7px;
    margin-left: 165px;
    margin-top: 65px;
    border-radius: 50px;
    color: white;
    padding-left: 7px;
    top: 27px;

}
.listview1 {
  background: rgb(68, 231, 68);
  width: 80px;
  color: white;
  height: 30px;
  border-radius: 50px;

  padding-left: 10px;
  top: 11px;
}
.listview2 {
  background: rgb(70, 11, 117);
  width: 80px;
  height: 30px;
  border-radius: 50px;
  color: white;

  padding-left: 10px;
  top: 11px;
}
</style>
