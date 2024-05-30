<template lang="pug">

q-card(color="white" class="q-pa-md container")
    q-card-section
      .flex.column
        h6 Esqueceu a senha?
    q-separator(class='q-mb-md')
    q-card-section(class="q-pt-md")
      q-form(@submit.prevent="onSubmit"  class="q-gutter-sm collum" )
        q-input(outlined label="Email" v-model="email" type="email" class="q-mb-md" dense :rules="[ val => val && val.length > 0 || 'CAMPO OBRIGATÓRIO', val => /.+@.+\..+/.test(val) || 'EMAIL INVÁLIDO', val => /.+@.+\.com$/.test(val) || 'EMAIL DEVE TERMINAR EM .COM' ]")
        q-input(outlined label="Password" v-model="password" :type="isPwd ? 'password' : 'text'" class="q-my-md" dense :rules="[ val => val && val.length > 0 || 'CAMPO OBRIGATÓRIO' ]")
          template(v-slot:append)
            q-icon(
              :name="isPwd ? 'visibility_off' : 'visibility'"
              class="cursor-pointer"
              @click="isPwd = !isPwd"
            )
        q-btn(label="Confirmar" :loading="loading" type="submit" color="primary" class="col-3")
        router-link(to="/" class="col q-mx-md")
          q-btn(color="primary" label="Voltar" @click="NewAccont" dense class="" flat :ripple="{  center: true }")

    //- q-card-section
      q-card-action(class="row")
        router-link(to="/" class="col q-mx-md")
          q-btn(color="primary" label="Confirmar" @click="Login" dense class="" flat  :ripple="{  center: true }" )
        q-space
</template>
<script setup>
import userService from "src/services/userService";
import { ref } from "vue";
const email = ref("");
const password = ref("");
const isPwd = ref(true);
const lodingLogin = ref(false);
const lodingNewAccont = ref(false);
const loading = ref(false);

const onSubmit = async () => {
  loading.value = true; 
  console.clear();
  const body = {
    password: password.value,
    email: email.value,
  };
  console.log(body);
  const user = new userService();
  const res = await user.resetpassword(body);
  console.log(res.data);
  if (res.data.status) {
    localStorage.setItem("user", res.data.user);
    history.pushState(null, "", "#/");
    location.reload();
  }
};

const Login = () => {
  lodingLogin.value = true;
};
const NewAccont = () => {
  lodingNewAccont.value = true;
};
</script>
<style scoped>
.container {
  min-width: 400px;
}
</style>
