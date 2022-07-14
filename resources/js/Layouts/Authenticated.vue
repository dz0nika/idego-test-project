<template>
  <div>
    <div class="min-h-screen bg-gray-50 md:flex md:flex-col">
      <div class="md:h-screen md:flex md:flex-col">
        <header class="bg-white border-b border-gray-100">
          <!-- Header -->
          <div class="w-full shadow-md">
            <div class="flex justify-between h-16">
              <div
                class="
                  md:flex-shrink-0 md:w-56
                  px-6
                  py-4
                  flex
                  items-center
                  justify-between
                  md:justify-center md:bg-gray-50
                "
              >
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                  <Link :href="route('dashboard')">
                    <img :src="$page.props.logo" class="h-12 w-auto" alt="logo" />
                  </Link>
                </div>
              </div>

              <div class="hidden md:flex md:items-center md:ml-6">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                  <Dropdown align="right" width="48">
                    <template #trigger>
                      <span class="inline-flex rounded-md">
                        <button
                          type="button"
                          class="
                            inline-flex
                            items-center
                            px-3
                            py-2
                            border border-transparent
                            text-sm
                            leading-4
                            font-medium
                            rounded-md
                            text-gray-500
                            bg-white
                            hover:text-gray-700
                            transition
                            ease-in-out
                            duration-150
                          "
                        >
                          {{ $page.props.auth.user.name }}
                          <Icon name="cheveron-down" class="h-4 w-4 fill-current ml-2" />
                        </button>
                      </span>
                    </template>

                    <template #content>
                      <DropdownLink :href="route('logout')" method="post" as="button">
                        <div class="flex items-center space-x-1">
                          <Icon name="logout" class="h-4 w-4 fill-current" />
                          <span>Logout</span>
                        </div>
                      </DropdownLink>
                    </template>
                  </Dropdown>
                </div>
              </div>

              <!-- Hamburger -->
              <div class="mr-2 flex items-center md:hidden">
                <button
                  @click="toggleNavigationDropdown"
                  class="
                    inline-flex
                    items-center
                    justify-center
                    p-2
                    rounded-md
                    text-gray-400
                    hover:text-gray-500 hover:bg-gray-100
                    focus:outline-none focus:bg-gray-50 focus:text-gray-500
                    transition
                    duration-150
                    ease-in-out
                  "
                >
                  <Icon
                    :name="showingNavigationDropdown ? 'x' : 'hamburger-menu'"
                    class="h-6 w-6 fill-gray-500"
                  />
                </button>
              </div>
            </div>
          </div>

          <!-- Responsive Navigation Menu -->

          <div
            :class="{
              block: showingNavigationDropdown,
              hidden: !showingNavigationDropdown,
            }"
            class="md:hidden"
          >
            <MainMenu />

            <!-- Responsive Settings Options -->
            <div class="pt-2 pb-1 border-t border-gray-200">
              <div class="mt-3 space-y-1">
                <NavLink :href="route('logout')" method="post" as="button">
                  <div class="flex items-center space-x-1">
                    <Icon name="logout" class="h-4 w-4 fill-current" />
                    <span>Logout</span>
                  </div>
                </NavLink>
              </div>
            </div>
          </div>
        </header>

        <div class="md:flex md:flex-grow md:overflow-hidden">
          <!-- Sidebar -->
          <div class="hidden md:block bg-white flex-shrink-0 w-56 py-8 overflow-y-auto shadow-lg">
            <MainMenu />
          </div>
          <!-- Page Content -->
          <main class="md:flex-1 px-4 py-8 md:p-8 md:overflow-y-auto" scroll-region>
            <FlashMessages />
            <slot />
          </main>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import useVisibility from '@/Composables/useVisibility'
import Dropdown from '@/Components/Dropdown'
import DropdownLink from '@/Components/DropdownLink'
import NavLink from '@/Components/NavLink'
import MainMenu from '@/Components/MainMenu'
import Icon from '@/Components/Icon'
import FlashMessages from '@/Components/FlashMessages'
import { Link } from '@inertiajs/inertia-vue3'

const { visible: showingNavigationDropdown, toggle: toggleNavigationDropdown } =
  useVisibility(false)
</script>
