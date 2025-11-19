<template>
    <div class="p-4 max-w-5xl mx-auto">

        <SearchBar v-model="search" />

        <div class="mt-6 space-y-10">
            <MenuCategory 
                v-for="cat in filteredCategories" 
                :key="cat.id" 
                :category="cat"
                @add-to-cart="addToCart"
            />
        </div>

        <FloatingCart />
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import axios from "axios";
import MenuCategory from "../components/MenuCategory.vue";
import SearchBar from "../components/SearchBar.vue";
import FloatingCart from "../components/FloatingCart.vue";
import { useCartStore } from "../store/cart";

const cart = useCartStore();

const slug = route().params.slug;
const provider = ref({});
const categories = ref([]);
const search = ref("");

onMounted(async () => {
    const { data } = await axios.get(`/api/public/menu/${slug}`);
    provider.value = data.provider;
    categories.value = data.categories;
});

const filteredCategories = computed(() => {
    if (!search.value) return categories.value;
    
    return categories.value.map(cat => ({
        ...cat,
        items: cat.items.filter(i =>
            i.item_name.toLowerCase().includes(search.value.toLowerCase())
        )
    })).filter(cat => cat.items.length > 0);
});

function addToCart(item) {
    cart.addItem(item);
}
</script>
