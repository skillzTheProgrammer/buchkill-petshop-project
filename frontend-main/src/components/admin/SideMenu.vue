<template>
  <div class="h-[full-80px] mt-[80px] bg-[#EDF5F1] w-64 flex flex-col shadow-xl">
    <nav class="p-0">
      <ul>
        <li v-for="item in menuItems" :key="item.text" class="mb-2">
          <router-link
            :to="item.path"
            class="flex items-center p-2 text-gray-700 hover:text-white hover:bg-primary"
            :class="{
              'hover:text-white bg-primaryDark text-white': isActiveRoute(item.path),
            }"
          >
            <span
              v-html="item.icon"
              :class="{
                'text-white': isActiveRoute(item.path),
                'text-gray-700': !isActiveRoute(item.path),
              }"
              class="mr-2"
            ></span>
            <p
              :class="{
                'text-white': isActiveRoute(item.path),
                'text-gray-700': !isActiveRoute(item.path),
              }"
            >
              {{ item.text }}
            </p>
          </router-link>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { useRoute } from "vue-router";
import { HOME_ROUTE, CUSTOMERS_ROUTE } from "@/router";

export default defineComponent({
  setup() {
    const route = useRoute();

    const menuItems = [
      {
        text: "Dashboard",
        path: HOME_ROUTE,
        icon: `<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_9501_3376)"><path d="M3.03906 17.1982V19.1982H9.03906V17.1982H3.03906ZM3.03906 5.19824V7.19824H13.0391V5.19824H3.03906ZM13.0391 21.1982V19.1982H21.0391V17.1982H13.0391V15.1982H11.0391V21.1982H13.0391ZM7.03906 9.19824V11.1982H3.03906V13.1982H7.03906V15.1982H9.03906V9.19824H7.03906ZM21.0391 13.1982V11.1982H11.0391V13.1982H21.0391ZM15.0391 9.19824H17.0391V7.19824H21.0391V5.19824H17.0391V3.19824H15.0391V9.19824Z" fill="currentColor"/></g><defs><clipPath id="clip0_9501_3376"><rect width="24" height="24" fill="white" transform="translate(0.0390625 0.198242)"/></clipPath></defs></svg>`,
      },
      {
        text: "All tickets",
        path: "/admin/tickets",
        icon: `<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_9501_3385)">
                <path d="M22.0391 4.19824H2.03906V20.1982H22.0391V4.19824ZM4.03906 12.1982H8.03906V14.1982H4.03906V12.1982ZM14.0391 18.1982H4.03906V16.1982H14.0391V18.1982ZM20.0391 18.1982H16.0391V16.1982H20.0391V18.1982ZM20.0391 14.1982H10.0391V12.1982H20.0391V14.1982Z" fill="#69817B"/>
                </g>
                <defs>
                <clipPath id="clip0_9501_3385">
                <rect width="24" height="24" fill="white" transform="translate(0.0390625 0.198242)"/>
                </clipPath>
                </defs>
              </svg>
              `,
      },
      {
        text: "Shipment Locator",
        path: "/admin/shipment-locator",
        icon: `<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_9501_3393)">
                <g clip-path="url(#clip1_9501_3393)">
                <path d="M12.0391 2.19824C8.16906 2.19824 5.03906 5.32824 5.03906 9.19824C5.03906 14.4482 12.0391 22.1982 12.0391 22.1982C12.0391 22.1982 19.0391 14.4482 19.0391 9.19824C19.0391 5.32824 15.9091 2.19824 12.0391 2.19824ZM12.0391 11.6982C10.6591 11.6982 9.53906 10.5782 9.53906 9.19824C9.53906 7.81824 10.6591 6.69824 12.0391 6.69824C13.4191 6.69824 14.5391 7.81824 14.5391 9.19824C14.5391 10.5782 13.4191 11.6982 12.0391 11.6982Z" fill="#69817B"/>
                </g>
                </g>
                <defs>
                <clipPath id="clip0_9501_3393">
                <rect width="24" height="24" fill="white" transform="translate(0.0390625 0.198242)"/>
                </clipPath>
                <clipPath id="clip1_9501_3393">
                <rect width="24" height="24" fill="white" transform="translate(0.0390625 0.198242)"/>
                </clipPath>
                </defs>
              </svg>
              `,
      },
      {
        text: "Customers",
        path: CUSTOMERS_ROUTE,
        icon: `<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_9501_3402)">
                <g clip-path="url(#clip1_9501_3402)">
                <path d="M9.03906 12.1982C10.9691 12.1982 12.5391 10.6282 12.5391 8.69824C12.5391 6.76824 10.9691 5.19824 9.03906 5.19824C7.10906 5.19824 5.53906 6.76824 5.53906 8.69824C5.53906 10.6282 7.10906 12.1982 9.03906 12.1982ZM9.03906 7.19824C9.86906 7.19824 10.5391 7.86824 10.5391 8.69824C10.5391 9.52824 9.86906 10.1982 9.03906 10.1982C8.20906 10.1982 7.53906 9.52824 7.53906 8.69824C7.53906 7.86824 8.20906 7.19824 9.03906 7.19824ZM9.03906 13.9482C6.69906 13.9482 2.03906 15.1182 2.03906 17.4482V19.1982H16.0391V17.4482C16.0391 15.1182 11.3791 13.9482 9.03906 13.9482ZM4.37906 17.1982C5.21906 16.6182 7.24906 15.9482 9.03906 15.9482C10.8291 15.9482 12.8591 16.6182 13.6991 17.1982H4.37906ZM16.0791 14.0082C17.2391 14.8482 18.0391 15.9682 18.0391 17.4482V19.1982H22.0391V17.4482C22.0391 15.4282 18.5391 14.2782 16.0791 14.0082ZM15.0391 12.1982C16.9691 12.1982 18.5391 10.6282 18.5391 8.69824C18.5391 6.76824 16.9691 5.19824 15.0391 5.19824C14.4991 5.19824 13.9991 5.32824 13.5391 5.54824C14.1691 6.43824 14.5391 7.52824 14.5391 8.69824C14.5391 9.86824 14.1691 10.9582 13.5391 11.8482C13.9991 12.0682 14.4991 12.1982 15.0391 12.1982Z" fill="#69817B"/>
                </g>
                </g>
                <defs>
                <clipPath id="clip0_9501_3402">
                <rect width="24" height="24" fill="white" transform="translate(0.0390625 0.198242)"/>
                </clipPath>
                <clipPath id="clip1_9501_3402">
                <rect width="24" height="24" fill="white" transform="translate(0.0390625 0.198242)"/>
                </clipPath>
                </defs>
              </svg>
              `,
      },
      {
        text: "Products",
        path: "/admin/products",
        icon: `<svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g clip-path="url(#clip0_9501_3410)">
              <g clip-path="url(#clip1_9501_3410)">
              <path d="M20.0391 6.19824H12.0391L10.0391 4.19824H4.03906C2.93906 4.19824 2.04906 5.09824 2.04906 6.19824L2.03906 18.1982C2.03906 19.2982 2.93906 20.1982 4.03906 20.1982H20.0391C21.1391 20.1982 22.0391 19.2982 22.0391 18.1982V8.19824C22.0391 7.09824 21.1391 6.19824 20.0391 6.19824ZM20.0391 18.1982H4.03906V8.19824H20.0391V18.1982Z" fill="#69817B"/>
              </g>
              </g>
              <defs>
              <clipPath id="clip0_9501_3410">
              <rect width="24" height="24" fill="white" transform="translate(0.0390625 0.198242)"/>
              </clipPath>
              <clipPath id="clip1_9501_3410">
              <rect width="24" height="24" fill="white" transform="translate(0.0390625 0.198242)"/>
              </clipPath>
              </defs>
              </svg>
              `,
      },
    ];

    const isActiveRoute = (path: string) => {
      return route.path === path;
    };

    return { menuItems, isActiveRoute };
  },
});
</script>

<style scoped>
.bg-primary {
  background-color: #4ec690;
}
.router-link-exact-active svg {
  color: white;
}
</style>
