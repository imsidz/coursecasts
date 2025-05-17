<template>
    <!-- Card 1: Filters -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 text-gray-900">
        <nav class="space-y-3">
          <ul class="space-y-2">
            <li>
              <Link href="/" :class="{ 'font-bold': !query.filter && $page.component === 'Forum/Index' }">All discussions</Link>
            </li>
            <li>
              <Link href="/?filter[noreplies]=1" :class="{ 'font-bold': query.filter?.noreplies }">No replies</Link>
            </li>
            <li>
              <Link href="/?filter[solved]=1" :class="{ 'font-bold': query.filter?.solved }">Solved</Link>
            </li>
            <li>
              <Link href="/?filter[unsolved]=1" :class="{ 'font-bold': query.filter?.unsolved }">Unsolved</Link>
            </li>
          </ul>
  
          <ul class="space-y-2 border-t border-t-gray-100 pt-3" v-if="$page.props.auth.user">
            <li>
              <Link href="/?filter[mine]=1" :class="{ 'font-bold': query.filter?.mine }">My discussions</Link>
            </li>
            <li>
              <Link href="/?filter[participating]=1" :class="{ 'font-bold': query.filter?.participating }">Participating</Link>
            </li>
            <li>
              <Link href="/?filter[mentioned]=1" :class="{ 'font-bold': query.filter?.mentioned }">Mentioned</Link>
            </li>
          </ul>
        </nav>
      </div>
    </div>
  
    <!-- Card 2: Topics -->
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
      <div class="p-6 text-gray-900">
        <h2 class="text-lg font-semibold mb-3">Topics</h2>
        <TopicList :topics="$page.props.topics" :query="query" />
        <ul class="space-y-2">
          <li v-for="topic in topics" :key="topic.id">
            <Link :href="`/topics/${topic.slug}`" class="hover:underline text-blue-600">
              {{ topic.title }}
            </Link>
          </li>
        </ul>
      </div>
    </div>
  </template>
  
  <script setup>
  import { Link } from '@inertiajs/vue3';
  import TopicList from '@/Components/Forum/TopicList.vue'
  
  defineProps({
    query: Object,
    topics: Array
  })
  </script>
  