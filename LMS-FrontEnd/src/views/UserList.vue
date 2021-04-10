<template>
  <div>
    <AppBar />
    <v-container>
      <v-row>
        <v-col cols="12">
          <v-card>
            <v-container>
              <v-row>
                <v-col cols="6">
                 
                </v-col>
                <v-col cols="4"> </v-col>
                <v-col cols="2">
                  <v-btn depressed color="primary" @click="Create()">
                    Add
                  </v-btn>
                </v-col>
              </v-row>
            </v-container>
          </v-card>
        </v-col>
        <v-col cols="12">
          <v-card>
            <div class="container">
              <h2>Users List</h2>
              <ul class="responsive-table">
                <li class="table-header">
                  <div class="col col-1">ID</div>
                  <div class="col col-2">Name</div>
                  <div class="col col-3">Email</div>
                  <div class="col col-4">Actions</div>
                </li>
                <div v-for="item in UsersData" :key="item">
                  <li class="table-row">
                    <div class="col col-1">{{ item.id }}</div>
                    <div class="col col-2">{{ item.name }}</div>
                    <div class="col col-3">{{ item.email }}</div>
                    <div class="col col-4">
                      <button @click="edit(item.id)" class="actionicons">Edit</button>

                      <button @click="deleteitem(item.id)" class="actionicons1">Delete</button>
                    </div>
                  </li>
                </div>
              </ul>
            </div>
          </v-card>
        </v-col>
      </v-row>
    </v-container>

    <v-dialog v-model="dialog" max-width="500px">
      <v-card>
        <v-card-title>
          <span class="headline" v-if="!editForm">Create</span>
          <span class="headline" v-else>Edit</span>
        </v-card-title>
        <v-card>
          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="6">
                  <v-text-field
                    outlined
                    v-model="User.name"
                    placeholder="Name"
                    label="Name"
                  ></v-text-field>
                </v-col>

                <v-col cols="6">
                  <v-text-field
                    outlined
                    v-model="User.email"
                    label="Email"
                    type="email"
                    placeholder="Email"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" >
                  <v-text-field
                    outlined
                    v-model="User.password"
                    placeholder="Password"
                    label="Password"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" >
                  <v-text-field
                    outlined
                    v-model="User.password_confirmation"
                    placeholder="Confirm Password"
                    label="Confirm Password"
                  ></v-text-field>
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="error" @click="cancel">
              Cancel
            </v-btn>
            <v-btn depressed v-if="!editForm" color="primary" @click="save">
              Save
            </v-btn>
            <v-btn
              depressed
              v-else
              color="primary"
              @click="updateForm(User.id)"
            >
              Update
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-card>
    </v-dialog>
  </div>
</template>
<script>
import AppBar from "../components/AppBar";
export default {
  components: {
    AppBar
  },
  data() {
    return {
      UsersData: [],
      SearchBook: "",
      editForm: false,
      User: {
        name: "",
        email: "",
        password: "",
        password_confirmation: ""
      },
      dialog: false,
      headers: [
        {
          text: "Title",
          align: "start",
          sortable: false,
          value: "name"
        },
        { text: "Description", value: "description" },
        { text: "Type", value: "type" },
        { text: "Price", value: "price" }
      ]
    };
  },

  methods: {
   
    Create() {
      this.dialog = true;
    },

    updateForm(index) {
      const axios = require("axios");
      axios
        .put(" http://localhost:8000/api/users/" + index, this.User)
        .then(response => {
          // handle success
          this.dialog = false;
          this.User = {};

          this.GetUsersData();
          console.log(response);
        })
        .catch(error => {
          // handle error
          console.log(error);
        });
    },
    edit(index) {
      this.editForm = true;
      const axios = require("axios");
      axios
        .get("http://localhost:8000/api/users/" + index)
        .then(response => {
          // handle success
          this.User = response.data.data;
          this.dialog = true;

          console.log(response);
        })
        .catch(error => {
          // handle error
          console.log(error);
        });
    },
    cancel() {
      this.dialog = false;
    },
    deleteitem(index) {
      const axios = require("axios");
      axios
        .delete("http://localhost:8000/api/users/" + index)
        .then(response => {
          // handle success
          this.GetUsersData();
          console.log(response);
        })
        .catch(error => {
          // handle error
          console.log(error);
        });
    },
    save() {
      const axios = require("axios");
      axios
        .post(" http://localhost:8000/api/users", this.User)
        .then(response => {
          // handle success
          this.User = {};
          this.dialog = false;

          this.GetUsersData();
          console.log(response);
        })
        .catch(error => {
          // handle error
          console.log(error);
        });
    },
    
    GetUsersData() {
      const axios = require("axios");
      axios
        .get(" http://localhost:8000/api/users")
        .then(response => {
          // handle success
          this.UsersData = response.data.data;
          console.log(response);
        })
        .catch(error => {
          // handle error
          console.log(error);
        });
    }
  },
  created() {
    this.GetUsersData();
  }
};
</script>
<style>
.actionicons{
height: 30px;
    background: blueviolet;
    width: 75px;
    border-radius: 16px;
    margin-right: 17px;
    color: white;
}
.actionicons1{
height: 32px;
    background: rgb(226, 43, 43);
    width: 75px;
    border-radius: 16px;
    margin-right: 17px;
    color: white;
}
   
</style>
<style lang="scss">
 
.container {
  max-width: 1000px;
  margin-left: auto;
  margin-right: auto;
  padding-left: 10px;
  padding-right: 10px;
}

h2 {
  font-size: 26px;
  margin: 20px 0;
  text-align: center;
  small {
    font-size: 0.5em;
  }
}

.responsive-table {
  li {
    border-radius: 3px;
    padding: 0px;
    display: flex;
    justify-content: space-between;
    margin-bottom: 25px;
  }
  .table-header {
    background-color: #95a5a6;
    font-size: 12px;
    height: 50px;
    text-transform: uppercase;
    letter-spacing: 0.03em;
  }
  .table-row {
    background-color: #ffffff;
    box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 0.1);
  }
  .col-1 {
    flex-basis: 10%;
  }
  .col-2 {
    flex-basis: 40%;
  }
  .col-3 {
    flex-basis: 25%;
  }
  .col-4 {
    flex-basis: 25%;
  }

  @media all and (max-width: 767px) {
    .table-header {
      display: none;
    }
    .table-row {
    }
    li {
      display: block;
    }
    .col {
      flex-basis: 100%;
    }
    .col {
      display: flex;
      padding: 10px 0;
      &:before {
        color: #6c7a89;
        padding-right: 10px;
        content: attr(data-label);
        flex-basis: 50%;
        text-align: right;
      }
    }
  }
}
</style>
