<template>
    <div class="container mx-auto bg-gray-200 rounded-xl shadow border p-8 m-10">
        <p class="text-gray-700 font-bold mb-5 text-lg">
            Deposit
        </p>
        <div class="grid grid-cols-1 gap-1 md:mt-0 sm:max-w-xl"><!-- md:mt-0 sm:max-w-md -->

            <current-balance></current-balance>

            <div class="w-full bg-white rounded-lg shadow dark:border xl:p-0 dark:bg-gray-500 dark:border-gray-500">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <form class="space-y-4 md:space-y-6" action="#">

                        <div v-if="displayErrors.active" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <div class="block" v-for="items in errors" :key="items">
                                <p class="block" v-for="item in items" :key="item">
                                    {{ item }}
                                </p>
                            </div>
                            <a href="#" @click="closeError" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </a>
                        </div>

                        <div>
                            <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                            <input type="number" name="amount" id="amount" v-model="formData.amount" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="USD" required="">
                            <span class="text-sm text-gray-400">
                                *The money will be deposited in your account once the check is accepted.
                            </span>
                        </div>
                        <div>
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <input type="text" name="description" id="description" v-model="formData.description" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <div>
                            <label for="created_at" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>


                             <div v-if="image.files.length > 0" class="grid grid-cols-1 gap-1">
                                <div class="rounded-md">
                                    <div class="grid grid-cols-2 gap-0">
                                        <div class="bg-gray-50 dark:bg-gray-400 p-4 rounded-tl-md rounded-bl-md" v-for="(file, index) in image.files" :key="index">
                                            <img :src="imageSrc" :alt="file.name" class="border border-solid border-transparent w-full h-100"/>
                                        </div>
                                        <div class="bg-gray-50 dark:bg-gray-400 p-4 rounded-tr-md rounded-br-md text-right font-semibold text-gray-900 dark:text-white align-middle">
                                            <button type="button" @click="handleClickDeleteFile(index)" class="mt-4 bg-white hover:bg-white focus:ring-4 outline outline-inset-2 text-blue-600 outline-blue-500 focus:outline-none focus:ring-white font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-white dark:hover:bg-gray-100 dark:focus:ring-white">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div v-else class="dropzone" v-bind="getRootProps()">
                                <div class="flex items-center justify-center w-full">
                                    <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg aria-hidden="true" class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                                            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                                        </div>
                                        <input type="file" v-bind="getInputProps()" />
                                    </label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" @click="handleSubmit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Deposit Check</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, shallowRef, triggerRef, reactive, onMounted} from 'vue'
import { Deposit } from '../interfaces';
import { useRouter } from 'vue-router'
import { DepositService } from '../services';
import CurrentBalance from '../components/CurrentBalance.vue';
import { useDropzone } from "vue3-dropzone";
import { useStore } from 'vuex'

export default defineComponent({
    name: 'Deposit',
    components: { CurrentBalance },
    setup(){
        const store = useStore()
        const formData = ref(DepositService.getDepositForm());
        let errors = shallowRef({ messages: [] })
        let displayErrors = shallowRef({active: false});
        const router = useRouter();
        const image = reactive({files: [],});
        const imageSrc = ref('');

        function handleSubmit(e: any) {
            e.preventDefault()
            DepositService.deposit(formData.value as Deposit, store.state.token)
                .then(response => {
                    if(response.success){
                        console.log(response)
                        router.push('/checks')
                    }else{
                        displayErrors.value.active = true
                        triggerRef(displayErrors)
                        errors.value = {...response.messages}
                        triggerRef(errors)
                    }
                })
                .catch((error) => {
                    console.error(error);
                });
        }

        function closeError() {
            displayErrors.value.active = false
            triggerRef(displayErrors)
            errors.value = { messages: [] }
            triggerRef(errors)
        }

        function onDrop(acceptFiles: any, rejectReasons: any) {
            image.files = acceptFiles
            if(image.files && image.files[0]){
                imageSrc.value = URL.createObjectURL(image.files[0])
                formData.value.image = image.files[0]
            }
        }

        function handleClickDeleteFile(index: number) {
            image.files.splice(index, 1);
        }

        const { getRootProps, getInputProps } = useDropzone({ onDrop });


        return {
            formData,
            router,
            errors,
            displayErrors,
            handleSubmit,
            getRootProps,
            getInputProps,
            closeError,
            handleClickDeleteFile,
            image,
            imageSrc,
            store
        }
    }
})
</script>

<style lang="scss" scoped>
.dropzone,
.files {
  width: 100%;
  max-width: 400px;
  margin: 0 auto;
  padding: 10px;
  border-radius: 8px;
  box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px,
    rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
  font-size: 12px;
  line-height: 1.5;

    // .delete-file {
    //     background: red;
    //     color: #fff;
    //     padding: 5px 10px;
    //     border-radius: 4px;
    //     cursor: pointer;
    // }
}

.border-upload {
  border: 2px dashed #ccc;
  border-radius: 8px;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  transition: all 0.3s ease;
  background: #fff;

  &.isDragActive {
    border: 2px dashed #ffb300;
    background: rgb(255 167 18 / 20%);
  }
}

.file-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding-left: 4px;
//   border-radius: 8px;
//   background: rgb(255 167 18 / 20%);
//   padding: 7px;
//   padding-left: 15px;
//   margin-top: 10px;

//   &:first-child {
//     margin-top: 0;
//   }
}

</style>
