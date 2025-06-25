import { defineStore } from 'pinia';
import { ref, computed } from 'vue';

export interface Admin {
  id: number;
  name: string;
  email: string;
  created_at: string;
  updated_at: string;
}

export const useAdminStore = defineStore('admin', () => {
  const admin = ref<Admin | null>(null);
  const token = ref<string | null>(localStorage.getItem('admin_token'));

  // Load admin from localStorage if token exists
  if (token.value && !admin.value) {
    const adminData = localStorage.getItem('admin_user');
    if (adminData) {
      admin.value = JSON.parse(adminData);
    }
  }

  const isAuthenticated = computed(() => !!token.value && !!admin.value);

  function setAdmin(adminData: Admin) {
    admin.value = adminData;
    localStorage.setItem('admin_user', JSON.stringify(adminData));
  }

  function setToken(tokenValue: string) {
    token.value = tokenValue;
    localStorage.setItem('admin_token', tokenValue);
  }

  function logout() {
    admin.value = null;
    token.value = null;
    localStorage.removeItem('admin_token');
    localStorage.removeItem('admin_user');
  }

  return {
    admin,
    token,
    isAuthenticated,
    setAdmin,
    setToken,
    logout
  };
}); 