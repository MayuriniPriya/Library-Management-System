<template>

  <div class="container">
  <div class="left">
    <div class="header">
      <h2 class="animation a1">Welcome Back</h2>
      <h4 class="animation a2">Create your account using email and password</h4>
    </div>
    <div class="form">
      <input  class="form-field animation a3" v-model="User.name" placeholder="Username">
      <input type="email" class="form-field animation a4" v-model="User.email" placeholder="Email">
      <input type="password" class="form-field animation a4" v-model="User.password" placeholder="Password">
      <input type="password" class="form-field animation a4" v-model="User.password_confirmation" placeholder="Password confirmation">
      <button class="animation a6" @click="register">Register</button>
      <br>
    </div>
  </div>
  <div class="right"></div>
</div>

 
</template>

<script>
export default {
  name: "Login",
  components: {  },
  data() {
    return {
       User: {
        name: "",
        email: "",
        password: "",
        password_confirmation: ""
      },
     
      nameRules: [v => !!v || `${this.$t("name")} ${this.$t("isRequired")}`],
      passwordRules: [
        v => !!v || `${this.$t("password")} ${this.$t("isRequired")}`,
        v => v.length >= 6 || this.$t("passwordLength", { length: 6 })
      ],
      c_passwordRules: [
        v =>
          !this.isRegisterForm ||
          !!v ||
          `${this.$t("password")} ${this.$t("isRequired")}`,
        v => v == this.form.password || this.$t("passwordConfirm")
      ]
    };
  },
  methods: {
    register() {
      const axios = require("axios");
      // Make a request for a user with a given ID
      axios
        .post(" http://localhost:8000/api/users",this.User)
        .then(function(response) {
          // handle success
      this.$router.push("/books-list")

          console.log(response);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        });
    },
    
  }
};
</script>


<style lang="scss">
* { box-sizing: border-box; }
@import url('https://fonts.googleapis.com/css?family=Rubik:400,500&display=swap');


body {
  font-family: 'Rubik', sans-serif;
}

.container {
  display: flex;
  height: 100vh;
}

.left {
  overflow: hidden;
  display: flex;
  flex-wrap: wrap;
  flex-direction: column;
  justify-content: center;
  animation-name: left;
  animation-duration: 1s;
  animation-fill-mode: both;
  animation-delay: 1s;
}

.right {
  flex: 1;
  background-color: black;
  transition: 1s;
  background-image: url(https://images.unsplash.com/photo-1550745165-9bc0b252726f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2250&q=80);
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}



.header > h2 {
  margin: 0;
  color: #4f46a5;
}

.header > h4 {
  margin-top: 10px;
  font-weight: normal;
  font-size: 15px;
  color: rgba(0,0,0,.4);
}

.form {
  max-width: 80%;
  display: flex;
  flex-direction: column;
}

.form > p {
  text-align: right;
}

.form > p > a {
  color: #000;
  font-size: 14px;
}

.form-field {
  height: 46px;
  padding: 0 16px;
  border: 2px solid #ddd;
  border-radius: 4px;
  font-family: 'Rubik', sans-serif;
  outline: 0;
  transition: .2s;
  margin-top: 20px;
}

.form-field:focus {
  border-color: #0f7ef1;
}

.form > button {
  padding: 12px 10px;
  border: 0;
  background: linear-gradient(to right, #de48b5 0%,#0097ff 100%); 
  border-radius: 3px;
  margin-top: 10px;
  color: #fff;
  letter-spacing: 1px;
  font-family: 'Rubik', sans-serif;
}

.animation {
  animation-name: move;
  animation-duration: .4s;
  animation-fill-mode: both;
  animation-delay: 2s;
}

.a1 {
  animation-delay: 2s;
}

.a2 {
  animation-delay: 2.1s;
}

.a3 {
  animation-delay: 2.2s;
}

.a4 {
  animation-delay: 2.3s;
}

.a5 {
  animation-delay: 2.4s;
}

.a6 {
  animation-delay: 2.5s;
}

@keyframes move {
  0% {
    opacity: 0;
    visibility: hidden;
    transform: translateY(-40px);
  }

  100% {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
  }
}

@keyframes left {
  0% {
    opacity: 0;
    width: 0;
  }

  100% {
    opacity: 1;
    padding: 20px 40px;
    width: 440px;
  }
}
</style>