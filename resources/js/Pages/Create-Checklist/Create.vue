<style>

#content {
  display: none; /* Hide the content initially */
  margin-top: 20px;
}
 
</style>

<script setup>
  import NavBarLayout from '@/Layouts/AppLayout.vue';
  import { Link, useForm } from '@inertiajs/vue3';
  import { reactive } from 'vue'

  function createForm() {
    // Send user input to ResponseController
    router.post('/generate', form_config);
  }
 
</script>

<template>
    <NavBarLayout>
      <div>
          <div class="container mx-auto p-4 px-20">

              
              
              <!-- Form Start -->
              <form id="forms" method="post">
                <!-- Page Label -->
                <p class="text-4xl font-bold">Create Check Sheet</p>

                <!-- Form Name Input Field -->
                <div class="flex p-4">
                    <p class="text-xl pt-1 pr-4">Check Sheet Name</p>
                    <input v-model="form_config.form_name" class="w-1/2 rounded-lg" type="text">
                </div>
                <!-- Section Looper -->
                <div v-for="key in count" :key="key">
                  <div class="p-4">
                    <div class="bg-white p-4 rounded-lg">
                      <div class="grid grid-cols-5 p-4 rounded-lg bg-slate-300">

                        <!-- Section Label -->
                        <div class="col-span-4">
                          <p class="text-xl">Section Name</p>
                        </div>

                        <!-- Section Label -->
                        <div class="">
                          <p class="text-xl">Section Type</p>
                        </div>

                        <!-- Section Name Input -->
                        <div class="col-span-4">
                          <input v-model="form_config.form_content['section' + key.toString()].section_name" class="w-11/12 rounded-lg" type="text" :name="'section_name'+key">
                        </div>

                        <!-- Section Type Input -->
                        <div>
                          <select v-model="form_config.form_content['section' + key.toString()].section_type" :name="'values' + key" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-m rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" style="border:1px solid gray">
                            <option selected>Choose a type</option>
                            <option :value="'question_'+key">Question</option>
                            <option :value="'instruction_'+key">Instruction</option>
                          </select>
                        </div>  

                      </div>
                      
                      <!-- Question-Type Section -->
                      <div v-if="form_config.form_content['section' + key.toString()].section_type === 'question_'+key">
                        <div style="padding-top:16px;">
                          <div class="grid grid-cols-5 p-4 rounded-lg bg-slate-300">
                            
                            <!-- Section Label -->
                            <div class="col-span-4">
                              <p class="text-xl">Question</p>
                            </div>
                            
                            <!-- Section Label -->
                            <div class="">
                              <p class="text-xl">Question Type</p>
                            </div>
                                  
                            <!-- Question Label Input  -->
                            <div class="col-span-4">
                              <input v-model="form_config.form_content['section' + key.toString()].section_content.question" class="w-11/12 rounded-lg" type="text">
                            </div>         
                                  
                            <!-- Question Type Options -->
                            <div class="">
                              <select id="selectBox" v-model="form_config.form_content['section' + key.toString()].section_content.type" :name="'v' + key" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-m rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" style="border:1px solid gray">
                                <option selected>Choose a type</option>
                                <option :value="'radio'">Radio</option>
                                <option :value="'check'">Check</option>
                                <option :value="'text'">Text</option>
                                <option :value="'dropbox'">Dropbox</option>
                              </select>
                            </div>
                            
                            <!-- If Question Type is Radio -->
                            <div class="col-span-2" v-if="form_config.form_content['section' + key.toString()].section_content.type === 'radio'">
                              <div class="">
                                <p class="text-xl">Radio Options</p>
                              </div>
                              
                              <!-- Radio Input Label -->
                              <input v-model="form_config.form_content['section' + key.toString()].section_content.answers['ans' + key.toString()]" class="w-11/12 rounded-lg" type="text">                              
                            </div>
                                  
                            <!-- If Question Type is Checkbox -->
                            <div class="col-span-2" v-if="form_config.form_content['section' + key.toString()].section_content.type === 'check'">    
                              <div class="">
                                <p class="text-xl">Checkbox Options</p>
                              </div>
                              <!-- Checkbox Input Label -->
                              <input v-model="form_config.form_content['section' + key.toString()].section_content.answers['ans' + key.toString()]" class="w-11/12 rounded-lg" type="text">                              
                            </div>
                            
                            <!-- If Question Type is Text -->
                            <div class="col-span-2" v-if="form_config.form_content['section' + key.toString()].section_content.type === 'text'">
                              <div class="">
                                <p class="text-xl">Textbox</p>
                              </div>

                              <input class="w-11/12 rounded-lg" style="background-color: #E5E5E5; border: 1px solid #B2B2B2;" type="text" placeholder="answer text" disabled>
                            </div>
                            
                            <!-- If Question Type is Dropdown -->
                            <div class="col-span-2" v-if="form_config.form_content['section' + key.toString()].section_content.type === 'dropbox'">
                              <div class="">
                                <p class="text-xl">Dropdown Options</p>
                              </div>
                              
                              <input v-model="form_config.form_content['section' + key.toString()].section_content.answers['ans' + key.toString()]" class="w-11/12 rounded-lg" type="text">                              
                            </div>

                          </div>
                        </div>
                      </div>
                      
                      <!-- Instruction-Type Section -->
                      <div v-if="form_config.form_content['section' + key.toString()].section_type === 'instruction_'+key">
                        <div style="padding-top:16px;">
                          <div class="grid grid-cols-5 p-4 rounded-lg bg-slate-300">

                            <div class="col-span-4">
                              <p class="text-xl">Instruction</p>
                            </div>

                            <div class="">
                              <p class="text-xl">Section Type</p>
                            </div>
                                      
                            <div class="col-span-4">
                                          <input class="w-11/12 rounded-lg" type="text">
                            </div>         
                                      
                            <div class="pt-2">
                              <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" value="" class="sr-only peer">
                              
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">

                                </div>

                                <p class="pl-4">Required</p>
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div> 
                </div>     
              </form>
                
          </div>
      </div> 

      <!-- Form Creation Options -->
      <footer class=" w-full h-16 fixed left-0 bottom-0
      flex justify-center items-center
      text-white text-2xl">
        <div class="container px-9 pb-5">
          <div class="px-9">
            <div class="px-9">
              <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-center">
                <button class="bg-white hover:bg-blue-400 text-black font-bold py-2 px-4 border border-b-4 border-black hover:border-blue-500 rounded-lg">
                  Back
                </button>

                <!-- Insert New Section -->
                <a href="#" id="add_more_fields" @click="add" >
                  <button class="bg-blue-500 mx-20 hover:bg-blue-400 text-black font-bold py-2 px-4 border border-b-4 border-blue-700 hover:border-blue-500 flex rounded-full"
                    >Add Section
                  </button>
                </a>

                <Link :href="route('generate.store', form_config)" as="button" method="POST" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border border-b-4 border-blue-700 hover:border-blue-500 rounded">
                    Create
                </Link>
                
                <!-- <a href="#" id="remove_fields" @click="remove"> <i class="fa fa-minus"></i> Remove Fields</a> -->
              </div>
            </div>
          </div>
        </div>
      </footer>
    </NavBarLayout >
</template>

<script>

  let form_config = reactive({
    form_name : null,
    form_content : {
      section1 : {
        section_name : null,
        section_type : null,
        section_content : {
          question : null,
          type : null,
          answers : {

          }
        }
      }
    }
  });

  function appendSection(num) {
    form_config.form_content['section' + num.toString()] = {
      section_name : null,
      section_type: null,
      section_content : {
        question : null,
        type : null,
        answers : {
          
        }
      }
    };
  }

  function appendQuestion() {

  }

  export default {
    name: 'App',

    // Define data
    data() {
      return {
        count: 1,
      };
    },
    methods:{
      add(){
        this.count++;
        appendSection(this.count);
      },
      remove(){
        if (this.count > 1) {
          delete this.values[this.count];
          this.count--;
        }
      }
    }
  };

</script>