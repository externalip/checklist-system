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

</script>

<template>
  <NavBarLayout>
    <div>

      <div class="container mx-auto p-4 px-20">

        <!-- Page Title -->
        <p class="text-4xl font-bold">Create Check Sheet</p>
        <div class="flex p-4">
            
            <p class="text-xl pt-1 pr-4">Check Sheet Name</p>
            <input class="w-1/2 rounded-lg" type="text">
        </div>

        <div v-for="key in count" :key="key">
          <div :name="'section_' + key" class="p-4">
            <div class="bg-white p-4 rounded-lg">
              <div class="grid grid-cols-5 p-4 rounded-lg bg-slate-300">
                <div class="col-span-4">
                  <p class="text-xl">Section Name</p>
                </div>
                <div class="col-span-4">
                  <input class="w-11/12 rounded-lg" type="text" :name="'section_name' + key">
                </div>
                <div>
                  <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full w-full"
                    @click="add1(key, values[key])">Add Question</button>
                </div>
              </div>
              <div v-for="questionIndex in values[key]" :key="questionIndex">
                <div style="padding-top:16px;">
                  <div class="grid grid-cols-5 p-4 rounded-lg bg-slate-300">
                    <div class="col-span-4">
                      <p class="text-xl">Question</p>
                    </div>
                    <div class="">
                      <p class="text-xl">Question Type</p>
                    </div>
                    <div class="col-span-4">
                      <input class="w-11/12 rounded-lg" type="text">
                    </div>
                    <div class="">
                      <select v-model="v[questionIndex]" :name="'v' + questionIndex"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-m rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        style="border:1px solid gray">
                        <option selected>Choose a type</option>
                        <option :value="'radio_' + questionIndex">Radio</option>
                        <option :value="'check_' + questionIndex">Check</option>
                        <option :value="'text_' + questionIndex">Text</option>
                        <option :value="'dropbox_' + questionIndex">Dropbox</option>
                      </select>
                    </div>
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
                        <div
                          class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <p class="pl-4">Required</p>
                      </label>
                    </div>
                    <div class="col-span-2" v-if="v[questionIndex] === 'radio_' + questionIndex">
                        <p>{{ questionIndex }}</p>
                      <div class="">
                        <p class="text-xl">Radio Options</p>
                      </div>
                      <input class="w-11/12 rounded-lg" type="text" :name="'radio' + key">
                    </div>
                    <div class="col-span-2" v-if="v[questionIndex] === 'check_' + questionIndex">
                      <div class="">
                        <p class="text-xl">Checkbox Options</p>
                      </div>
                      <input class="w-11/12 rounded-lg" type="text" :name="'check' + key">
                    </div>
                    <div class="col-span-2" v-if="v[questionIndex] === 'text_' + questionIndex">
                      <div class="">
                        <p class="text-xl">Textbox</p>
                      </div>
                      <input class="w-11/12 rounded-lg" type="text" :name="'text' + key">
                    </div>
                    <div class="col-span-2" v-if="v[questionIndex] === 'dropbox_' + questionIndex">
                      <div class="">
                        <p class="text-xl">Dropdown Options</p>
                      </div>
                      <input class="w-11/12 rounded-lg" type="text" :name="'dropbox' + key">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <footer class=" w-full h-16 fixed left-0 bottom-0
    flex justify-center items-center
    text-white text-2xl">
      <div class="container px-9 pb-5">
        <div class="px-9">
          <div class="px-9">
            <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-center">
              <button
                class="bg-white hover:bg-blue-400 text-black font-bold py-2 px-4 border border-b-4 border-black hover:border-blue-500 rounded-lg">
                Back
              </button>
              <a href="#" @click="add"><button
                  class="bg-blue-500 mx-20 hover:bg-blue-400 text-black font-bold py-2 px-4 border border-b-4 border-blue-700 hover:border-blue-500 flex rounded-full">Add
                  Section</button></a>
              <button
                class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-2 px-4 border border-b-4 border-blue-700 hover:border-blue-500 rounded">
                Create
              </button>

              <!-- <a href="#" id="remove_fields" @click="remove"> <i class="fa fa-minus"></i> Remove Fields</a> -->
            </div>
          </div>
        </div>
      </div>
    </footer>
  </NavBarLayout>
</template>

<script>
export default {
  name: 'App',
  //lets define the data
  data() {
    return {
      count: 1,
      i: 1,
      values: { 1: [1] },
      v: {},
    };
  },
  methods: {
    add() {
      this.count++;
      this.values[this.count] = [1];
    },
    remove() {
      if (this.count > 1) {
        delete this.values[this.count];
        this.count--;
      }
    },
    add1(sectionKey, sectionQuestions) {
      if (sectionQuestions) {
        sectionQuestions.push(sectionQuestions.length + 1);
      } else {
        this.$set(this.values, sectionKey, [1]);
      }
    }

  }
};

</script>