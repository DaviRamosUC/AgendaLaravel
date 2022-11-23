<script>
import router from '../router'
export default {
  data() {
    return {
      nome: '',
      sobrenome: '',
      email: '',
      telefone: '',
      cep: '',
      bairro: '',
      logradouro: '',
      numero: '',
      cidade: '',
      states: {
        'AC': 'Acre',
        'AL': 'Alagoas',
        'AP': 'Amapá',
        'AM': 'Amazonas',
        'BA': 'Bahia',
        'CE': 'Ceará',
        'DF': 'Distrito Federal',
        'ES': 'Espírito Santo',
        'GO': 'Goías',
        'MA': 'Maranhão',
        'MT': 'Mato Grosso',
        'MS': 'Mato Grosso do Sul',
        'MG': 'Minas Gerais',
        'PA': 'Pará',
        'PB': 'Paraíba',
        'PR': 'Paraná',
        'PE': 'Pernambuco',
        'PI': 'Piauí',
        'RJ': 'Rio de Janeiro',
        'RN': 'Rio Grande do Norte',
        'RS': 'Rio Grande do Sul',
        'RO': 'Rondônia',
        'RR': 'Roraíma',
        'SC': 'Santa Catarina',
        'SP': 'São Paulo',
        'SE': 'Sergipe',
        'TO': 'Tocantins',
      },
      estado: ''
    }

  },
  methods: {
    handleSearchPostalCode: async function (props) {
      const valorCep = props.target.value
      const APICEP = 'https://cep.awesomeapi.com.br/json/'
      if (valorCep) {
        await axios
          .get(`${APICEP + valorCep}`)
          .then(response => {
            const dados = response.data
            this.bairro = dados.district
            this.logradouro = dados.address_name
            this.cidade = dados.city
            this.estado = this.states[dados.state]

          }).catch(err => {
            console.error(err)
          });
      }
    },
    handleSubmit: async (submitEvent) => {
      const form = submitEvent.target.elements
      let nome = form.nome.value;
      let sobrenome = form.sobrenome.value;
      let email = form.email.value;
      let telefone = form.telefone.value;
      let logradouro = form.logradouro.value;
      let bairro = form.bairro.value;
      let numero = form.numero.value;
      let cidade = form.cidade.value;
      let estado = form.estado.value;
      let cep = form.cep.value;

      await axios
        .post(
          "/api/registercontact",
          {
            nome,
            sobrenome,
            email,
            telefone,
            cep,
            estado,
            bairro,
            logradouro,
            numero,
            cidade
          }
        )
        .then(response => {
          if(response.status == 200){
            router.push('/contactlist')
          }
        }).catch(err => {
          console.error(err)
        });
    }
  }
}
</script>

<template>
  <div class="mt-20 mx-20 my-20">
    <div class="md:grid md:grid-cols-2">
      <div class="mt-5 md:col-span-2 md:mt-0">
        <form @submit.prevent="handleSubmit">
          <div class="overflow-hidden shadow sm:rounded-md">
            <div class="bg-white px-4 py-5 sm:p-6">
              <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-3">
                  <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
                  <input type="text" name="nome" id="nome" autocomplete="given-name" required v-model="nome"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="sobrenome" class="block text-sm font-medium text-gray-700">Sobrenome</label>
                  <input type="text" name="sobrenome" id="sobrenome" autocomplete="family-name" required
                    v-model="sobrenome"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="email" class="block text-sm font-medium text-gray-700">Endereço de e-mail</label>
                  <input type="text" name="email" id="email" autocomplete="email" required v-model="email"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                  <input type="tel" name="telefone" id="telefone" autocomplete="tel" required v-model="telefone"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>

                <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                  <label for="cep" class="block text-sm font-medium text-gray-700">CEP</label>
                  <input type="text" name="cep" id="cep" autocomplete="postal-code" @focusout="handleSearchPostalCode"
                    onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="ex: 24910530" required
                    v-model="cep"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>

                <div class="col-span-6 sm:col-span-3">
                  <label for="estado" class="block text-sm font-medium text-gray-700">Estado</label>
                  <select id="estado" name="estado" autocomplete="country-name" required v-model="estado"
                    class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                    <option v-for="estado_nome in states" :key="estado_nome">{{ estado_nome }}</option>
                  </select>
                </div>

                <div class="col-span-3">
                  <label for="bairro" class="block text-sm font-medium text-gray-700">Bairro</label>
                  <input type="text" name="bairro" id="bairro" required v-model="bairro"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>

                <div class="col-span-3">
                  <label for="logradouro" class="block text-sm font-medium text-gray-700">Logradouro</label>
                  <input type="text" name="logradouro" id="logradouro" autocomplete="street-address" required
                    v-model="logradouro"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>


                <div class="col-span-3">
                  <label for="numero" class="block text-sm font-medium text-gray-700">Número</label>
                  <input type="text" name="numero" id="numero" v-model="numero"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>

                <div class="col-span-3 sm:col-span-6 lg:col-span-3">
                  <label for="cidade" class="block text-sm font-medium text-gray-700">Cidade</label>
                  <input type="text" name="cidade" id="cidade" autocomplete="address-level2" required v-model="cidade"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" />
                </div>
              </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
              <button type="submit"
                class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Enviar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
