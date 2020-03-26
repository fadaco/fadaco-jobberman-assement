<template>
    <v-container>
  <div>

      <div v-if="errors.length > 0">
          <v-alert :type="status ? 'success' : 'error'">
              <div v-for="error in errors">
                  {{error}}
              </div>
          </v-alert>
      </div>
      <v-form>
          <v-container>
              <v-row>
                  <v-col
                      cols="12"
                      md="4"
                  >
                      <v-text-field
                          v-model="body.first_name"
                          label="First name"
                          required
                      ></v-text-field>
                  </v-col>

                  <v-col
                      cols="12"
                      md="4"
                  >
                      <v-text-field
                          v-model="body.surname"
                          label="Surname"
                          required
                      ></v-text-field>
                  </v-col>

                  <v-col
                      cols="12"
                      md="4"
                  >
                      <v-text-field
                          v-model="body.email"
                          label="E-mail"
                          required
                      ></v-text-field>
                  </v-col>
              </v-row>
          </v-container>
      </v-form>
      <v-container>
      <v-col class="text-center" cols="12" sm="4">
          <div class="my-2">
      <v-btn  large color="primary" @click="submitUser">Submit</v-btn>
          </div>
      </v-col>
      </v-container>




      <v-container>
      <v-simple-table>
          <template v-slot:default>
              <thead>
              <tr>
                  <th class="text-left">Name</th>
                  <th class="text-left">Email</th>
                  <th class="text-left">Action</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="(user, index) in users" :key="index">
                  <td>{{ user.first_name}} {{user.surname}}</td>
                  <td>{{ user.email }}</td>
                  <td>    <v-btn @click="deleteUser(user.id, index)">delete</v-btn>
                  </td>
              </tr>
              </tbody>
          </template>
      </v-simple-table>
      </v-container>

  </div>
    </v-container>
</template>

<script>
    export default {
        name: "user",
        data(){
            return {
                body: {
                    first_name: '',
                    surname: '',
                    email: ''
                },
                user: {},
                users: [],
                status: null,
                errors: [],
                rules: {
                    required: value => !!value || 'Required.',
                    email: value => {
                        const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                        return pattern.test(value) || 'Invalid e-mail.'
                    },
                }
            }
        },
        mounted(){
            axios.get('/api/user')
                .then((res) => {
                    if (res.status === 200) {
                        this.users = [...res.data];
                    }
                })
                .catch((err) => {
                    console.log(err);
                })
        },
        methods: {
            submitUser(){
                console.log(this.body);
                axios.post('/api/user', this.body)
                    .then((res) => {
                        if (Array.isArray(res.data)){
                             this.errors = [...res.data];
                             this.status = false;
                        } else {
                            if (res.status === 201) {
                                console.log('res');
                                console.log(res);
                                this.errors = [];
                                this.status = true;
                                this.errors.push(res.message);
                                this.user = {...res.data};
                                this.users.unshift(res.data.data);
                            }
                        }
                    })
                    .catch((err) => {
                        console.log(err)
                    })
            },
            deleteUser(id, index) {
                this.users.splice(index, 1);
                axios.get(`/api/user/${id}`)
                    .then((res) => {
                        console.log(res);
                    })
                    .catch((err) => {
                        console.log(err);
                    })
            }

        }
    }
</script>

<style scoped>

</style>
