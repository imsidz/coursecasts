<template>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
      <div class="p-6 text-gray-900">
        <h2 class="text-lg font-semibold mb-3">Topics</h2>
        <ul class="space-y-2">
          <li>
            <a
              href="/"
              @click.prevent="filterByTopic('')"
              :class="[
                'block px-4 py-2 rounded hover:bg-gray-100',
                !query.filter?.topic ? 'font-bold text-blue-600' : 'text-gray-700'
              ]"
            >
              All Topics
            </a>
          </li>
          <li v-for="topic in topics" :key="topic.id">
            <a
              href="#"
              @click.prevent="filterByTopic(topic.slug)"
              :class="[
                'block px-4 py-2 rounded hover:bg-gray-100',
                query.filter?.topic === topic.slug ? 'font-bold text-blue-600' : 'text-gray-700'
              ]"
            >
              {{ topic.title }}
            </a>
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script setup>
  import { router } from '@inertiajs/vue3'
  import _omitBy from 'lodash.omitby'
  import _isEmpty from 'lodash.isempty'
  
  const props = defineProps({
    topics: Array,
    query: Object
  })
  
  const filterByTopic = (slug) => {
    router.visit('/', {
      data: _omitBy({
        'filter[topic]': slug
      }, _isEmpty),
      preserveScroll: true
    })
  }
  </script>
  