<template>
  <div class="login-page">
    <h2>Login</h2>

    <form @submit.prevent="loginUser">
      <label>Email</label>
      <input v-model="email" type="email" required>

      <label>Password</label>
      <input v-model="password" type="password" required>

      <button type="submit">Login</button>
    </form>

    <p style="color:red">{{ error }}</p>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      email: "",
      password: "",
      error: ""
    };
  },
  methods: {
    loginUser() {
      axios.post("http://127.0.0.1:8000/api/login", {
        email: this.email,
        password: this.password
      })
      .then(res => {
        console.log("Logged in:", res.data);

        // store user data
        localStorage.setItem("user", JSON.stringify(res.data.user));

        // redirect to dashboard
        this.$router.push("/dashboard");
      })
      .catch(err => {
        this.error = "Invalid email or password";
      });
    }
  }
};
</script>

<style>
.login-page {
  max-width: 400px;
  margin: 50px auto;
  display: flex;
  flex-direction: column;
}
input {
  width: 100%;
  padding: 8px;
  margin: 5px 0 15px;
}
button {
  padding: 10px;
  cursor: pointer;
}
</style>
