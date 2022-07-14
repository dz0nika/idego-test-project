<template>
  <div class="">
    <NavSectionTitle title="Navigation" />
    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
      <div class="flex items-center space-x-1">
        <Icon name="dashboard" class="h-4 w-4 fill-current" />
        <span>Dashboard</span>
      </div>
    </NavLink>
    <NavLink :href="route('users')" :active="route().current('users')">
      <div class="flex items-center space-x-1">
        <Icon name="users" class="h-4 w-4 fill-current" />
        <span>Users</span>
      </div>
    </NavLink>
  </div>
</template>

<script setup>
import NavLink from '@/Components/NavLink'
import Icon from '@/Components/Icon'
import NavSectionTitle from '@/Components/NavSectionTitle'
</script>
