<script setup>
import AlertComponent from '../components/AlertComponent.vue'
import router from '../router'

const handleSubmit = async (submitEvent) => {
  let nome = submitEvent.target.elements.first_name.value;
  let sobrenome = submitEvent.target.elements.last_name.value;
  let email = submitEvent.target.elements.email.value;
  let senha = submitEvent.target.elements.password.value
  let token = ''
  let mensagem = ''

  await axios
    .post(
      "/api/register",
      {
        nome,
        sobrenome,
        email,
        senha
      }
    )
    .then(response => {
      mensagem = response.data.mensage
      if (response.data.token) {
        token = response.data.token
        localStorage.setItem("token", token)
        router.push('/contactlist')
      }
    }).catch(err => {
      console.error(err)
    });
}

</script>

<template>
  <div class="flex h-full bg-white">
    <div class="mx-auto py-20 w-3/5">
      <div class="mt-20">
        <h2 class="text-lg font-semibold text-gray-900">Realize seu cadastro gratuitamente</h2>
        <p class="mt-2 text-sm text-gray-700">Já está registrado? <a class="font-medium text-blue-600 hover:underline"
            href="/login">Entre</a> em sua conta.</p>
      </div>
      <form @submit.prevent="handleSubmit" class="mt-10 grid grid-cols-1 gap-y-8 gap-x-6 sm:grid-cols-2">
        <div class="">
          <label for="first_name" class="mb-3 block text-sm font-medium text-gray-700">Nome</label>
          <input id="first_name" type="text" name="first_name" autocomplete="given-name" required="true"
            class="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm">
        </div>

        <div class="">
          <label for="last_name" class="mb-3 block text-sm font-medium text-gray-700">Sobrenome</label>
          <input id="last_name" type="text" name="last_name" autocomplete="family-name" required="true"
            class="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm">
        </div>

        <div class="col-span-full">
          <label for="email" class="mb-3 block text-sm font-medium text-gray-700">Endereço de e-mail</label>
          <input id="email" type="email" name="email" autocomplete="email" required="true"
            class="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm">
        </div>

        <div class="col-span-full">
          <label for="password" class="mb-3 block text-sm font-medium text-gray-700">Senha</label>
          <input id="password" type="password" name="password" autocomplete="new-password" required="true"
            class="block w-full appearance-none rounded-md border border-gray-200 bg-gray-50 px-3 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-500 focus:bg-white focus:outline-none focus:ring-blue-500 sm:text-sm">
        </div>

        <div class="col-span-full">
          <button
            class="group inline-flex items-center justify-center rounded-full py-2 px-4 text-sm font-semibold focus:outline-none focus-visible:outline-2 focus-visible:outline-offset-2 bg-blue-600 text-white hover:text-slate-100 hover:bg-blue-500 active:bg-blue-800 active:text-blue-100 focus-visible:outline-blue-600 w-full"
            type="submit">
            <span>Cadastrar-se <span aria-hidden="true">→</span></span>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
