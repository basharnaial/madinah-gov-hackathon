import { defineStore } from 'pinia';
import { ref } from 'vue';

export interface AlertState {
  type: 'success' | 'error' | 'info' | 'warning';
  message: string;
}

export const useUIStore = defineStore('ui', () => {
  const alert = ref<AlertState>({ type: 'info', message: '' });

  function showAlert(type: AlertState['type'], message: string) {
    alert.value = { type, message };
    setTimeout(() => {
      clearAlert();
    }, 5000);
  }

  function clearAlert() {
    alert.value = { type: 'info', message: '' };
  }

  return {
    alert,
    showAlert,
    clearAlert,
  };
}); 