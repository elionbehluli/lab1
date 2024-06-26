<template>
  <div class="flex h-screen">
    <DashboardSideBar @change-view="updateActiveComponent" />
    <div class="flex-1" style="margin-left: 17em">
      <!-- Dynamic component area -->
      <component :is="activeComponent"></component>
    </div>
  </div>
</template>

<script lang="ts" setup>
import DashboardSideBar from '@/components/DashboardSideBar.vue'
import DashboardUsers from '@/components/DashboardUsers.vue'
import DashboardMain from '@/components/DashboardMain.vue'
import DashboardCars from '@/components/DashboardCars.vue'
import DashboardCreateCar from '@/components/DashboardCreateCar.vue'
import DashboardServices from '@/components/DashboardServices.vue'
import DashboardAddService from '@/components/DashboardAddService.vue'

import { ref } from 'vue'

const activeComponent = ref(DashboardMain)

function updateActiveComponent(componentName: any) {
  switch (componentName) {
    case 'users':
      activeComponent.value = DashboardUsers
      break
    case 'cars':
      activeComponent.value = DashboardCars
      break
    case 'add-car':
      activeComponent.value = DashboardCreateCar
      break
    case 'services':
      activeComponent.value = DashboardServices
      break
    case 'add-service':
      activeComponent.value = DashboardAddService
      break
    default:
      activeComponent.value = DashboardMain
  }
}
</script>
