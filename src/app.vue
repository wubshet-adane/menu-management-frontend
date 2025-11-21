<template>
  <!-- HEADER -->
    <header class="bg-white shadow px-6 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-indigo-600">
            {{ message }} Dashboard
        </h1>

        <div class="flex items-center gap-4">
            <span class="font-semibold">{{  message }}</span>
            <form method="POST">
                <button class="group flex items-center gap-2 px-4 py-2 bg-red-500 text-white
                        rounded-lg hover:bg-red-600 shadow w-12 hover:w-32 transition-all duration-300 ease-in-out">
                    <i class="fa-solid fa-right-from-bracket text-xl leading-none"></i>
                    <span class="text-xl leading-none transform opacity-0 -translate-x-10
                        group-hover:opacity-100 group-hover:translate-x-0
                        transition-all duration-300 ease-in-out">
                        Logout
                    </span>
                </button>

            </form>
        </div>
    </header>
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
    axios.get("http://127.0.0.1:8000/api/categories")
      .then(res => {
        this.message = res.data;
      })
      .catch(err => {
        this.message = "Error happened to connect to API";
        console.error(err);
      });
  }
};
</script>
