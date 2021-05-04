<template>
    <!-- <div class="container"> -->
    <div class="row">
        <div class="col-md-12 border x-1">
            <div class="row bg-info">
                <p class="col-md-1 x-5" v-on:click="sortUsers('id')">Id</p>
                <p class="col-md-2 x-5">Name</p>
                <p class="col-md-2 x-5">Surname</p>
                <p class="col-md-3 x-5">Email</p>
                <p class="col-md-3 x-5">Was online</p>
                <p class="col-md-1 x-5" v-on:click="sortUsers('block')">Status</p>
            </div>
        </div>
        <div
            class="col-md-12 x-1"
            v-for="(item, i) in users"
            :key="i"
            :class="[item.block >= 1 ? 'border border-danger' : 'border']"
        >
            <div class="row x-3" :class="{ 'bg-warning': item.type == 1 }">
                <p
                    class="col-md-1 x-2"
                    v-on:click="info.user = info.user == i ? null : i"
                >
                    {{ item.id }}
                    <span class="text-info">more</span>
                </p>
                <p class="col-md-2 x-2">{{ item.name }}</p>
                <p class="col-md-2 x-2">{{ item.surname }}</p>
                <p class="col-md-3 x-2">{{ item.email }}</p>
                <p class="col-md-3 x-2" :class="{ 'bg-danger': !item.input }">
                    {{ item.input }}
                </p>
                <p
                    v-if="item.block == 0"
                    class="col-md-1 text-danger x-2"
                    v-on:click="block.status = block.status == i ? null : i"
                >
                    Block
                </p>
                <p
                    v-if="item.block == 1"
                    class="col-md-1 text-danger x-2 "
                    v-on:click="unBlockUser(item.id)"
                >
                    Unblock
                </p>
                <div v-if="info.user == i" class="row w-100 x-4">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <p>
                                    <b>Users are unblocked through</b>
                                    <span class="text-danger">{{
                                        item.unlocked
                                    }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div
                    v-if="block.status == i"
                    class="input-group input-group-sm mb-3 x-4"
                >
                    <div class="row w-100">
                        <div class="col-md-5">
                            <div class="input-group-prepend">
                                <span
                                    class="input-group-text"
                                    id="inputGroup-sizing-sm"
                                    >{{ block.msg || "Comment" }}</span
                                >
                                <input
                                    v-model="block.comment"
                                    autofocus
                                    type="text"
                                    class="form-control bg-light m-1"
                                    aria-label="Small"
                                    aria-describedby="inputGroup-sizing-sm"
                                />
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="exampleRadios"
                                            id="exampleRadios1"
                                            v-model="block.time"
                                            value="7"
                                            checked
                                        />
                                        <label
                                            class="form-check-label"
                                            for="exampleRadios1"
                                        >
                                            7 day
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="exampleRadios"
                                            id="exampleRadios1"
                                            v-model="block.time"
                                            value="14"
                                            checked
                                        />
                                        <label
                                            class="form-check-label"
                                            for="exampleRadios1"
                                        >
                                            14 day
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="exampleRadios"
                                            id="exampleRadios1"
                                            v-model="block.time"
                                            value="always"
                                            checked
                                        />
                                        <label
                                            class="form-check-label"
                                            for="exampleRadios1"
                                        >
                                            Always
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button
                                class="btn btn-outline-secondary btn-sm"
                                type="button"
                                v-on:click="blockUser(item.id)"
                            >
                                Block user
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

<script>
export default {
    data: function() {
        return {
            users: [],
            block: {
                status: null,
                comment: "",
                msg: "",
                time: ""
            },
            info: {
                user: null
            },
            sort: {
                users: [], sel: 0
            },
        };
    },
    methods: {
        createForm: function($obj) {
            let form = new FormData();
            for (let key in $obj) {
                form.append(key, $obj[key]);
            }
            return form;
        },
        blockUser: function(id) {
            if (!this.block.comment || !this.block.time) {
                return (this.block.msg = "Validate error");
            }
            axios
                .post(
                    "/block_user",
                    this.createForm({
                        id: id,
                        comment: this.block.comment,
                        time: this.block.time
                    })
                )
                .then(r => {
                    if (r.data == 1) {
                        this.get_users();
                        this.block = {
                            status: null,
                            comment: "",
                            msg: ""
                        };
                    }
                });
        },
        get_users: function() {
            axios.get("/get_users").then(r => {
                this.users = r.data;
            });
        },
        unBlockUser: function(id) {
            axios.post("/unblock_user", this.createForm({ id: id })).then(r => {
                if (r.data == 1) {
                    this.get_users();
                }
            });
        },
        sortUsers:function(key) {
            this.sort.users = this.users.slice()
            this.users = this.sort.sel % 2 == 0 ? this.users.sort((a, b) => b[key] - a[key]) : this.users.sort((a, b) => a[key] - b[key])
            this.sort.sel += 1
        }
    },
    mounted() {
        this.get_users();
    }
};
</script>
