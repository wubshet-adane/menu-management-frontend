<template>
  <h1>{{ message .name}}</h1>
  <h1>{{ message .email}}</h1>
  <h1>{{ message .phone}}</h1>
  <h1>{{ message .slug}}</h1>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      message: "Loading..."
    };
  },
  mounted() {
    axios.get("http://127.0.0.1:8000/api/public-menu/haset-cafe")
      .then(res => {
        this.message = res.data.provider;
      })
      .catch(err => {
        this.message = "Error connecting to API";
        console.error(err);
      });
  }
};
</script>
