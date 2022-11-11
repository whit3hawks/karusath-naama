<template>
    <div class="my-4">
        <div class="mb-4" v-if="isLoading">Loading...</div>
        <div
            class="mb-4 w-full flex items-center text-gray-800 outline-none px-3 h-12 rounded-lg border-dashed border-2 w-full border-gray-800 flex"
        >
            <input
                v-model="slug"
                placeholder="slug"
                type="Text"
                ref="slug"
                class="flex w-full outline-none"
            />
            <div
                v-on:click="search()"
                class="cursor-pointer text-gray-800 font-semibold"
            >
                Search
            </div>
        </div>
        <div
            class="mb-2 border-b border-gray-200 pb-4"
            v-if="searchTags.length !== 0"
        >
            <p
                class="mb-2 font-semibold text-gray-600"
                v-if="searchTags.length !== 0"
            >
                Search Results
            </p>
            <div class="flex flex-wrap -mx-2">
                <div
                    class="flex items-center rounded bg-gray-200 px-3 py-1 my-2 mx-2"
                    v-for="tag in searchTags"
                    :key="tag.id"
                >
                    <p class="w-full dv-bold text-gray-600">{{ tag.name }}</p>
                    <div
                        class="ml-2 text-blue-600 font-semibold text-sm cursor-pointer"
                        v-on:click="add(tag.id)"
                    >
                        +
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap -mx-2">
            <div
                class="flex items-center rounded bg-gray-200 px-3 my-2 py-1 mx-2"
                v-for="article_tag in tags"
                :key="article_tag.id"
            >
                <p class="w-full dv-bold text-gray-600">{{ article_tag.tag.name }}</p>
                <div
                    class="ml-2 text-red-600 font-semibold text-sm cursor-pointer"
                    v-on:click="remove(article_tag.id)"
                >
                    X
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ["id", "tags", "url"],
    data() {
        return {
            slug: "",
            searchTags: [],
            tags: [],
            isLoading: true,
        };
    },
    mounted() {
        this.init();
        console.log("Component mounted.");
    },
    methods: {
        search: function () {
            const vm = this;
            vm.isLoading = true;
            axios.get(`/api/tag-search/${this.slug}`).then(
                (response) => {
                    vm.isLoading = false;
                    vm.searchTags = response.data.tags;
                },
                (error) => {
                    vm.isLoading = false;
                    console.log("Error");
                }
            );
        },
        add: function ($tag_id) {
            const vm = this;
            vm.isLoading = true;
            axios
                .post(`${this.url}${this.id}`, {
                    tag_id: $tag_id,
                })
                .then(
                    (response) => {
                        vm.isLoading = false;
                        vm.tags = response.data.tags;
                        vm.searchTags = [];
                        vm.slug = "";
                    },
                    (error) => {
                        console.log("Error");
                    }
                );
        },
        remove: function ($id) {
            const vm = this;
            vm.isLoading = true;
            axios.get(`${this.url}${$id}/delete`).then(
                (response) => {
                    vm.isLoading = false;
                    vm.tags = response.data.tags;
                },
                (error) => {
                    vm.isLoading = false;
                    console.log("Error");
                }
            );
        },
        init: function () {
            const vm = this;
            vm.isLoading = true;
            axios.get(`${this.url}${this.id}`).then(
                (response) => {
                    vm.isLoading = false;
                    vm.tags = response.data.tags;
                },
                (error) => {
                    vm.isLoading = false;
                    console.log("Error");
                }
            );
        },
    },
};
</script>
