import axios, { AxiosInstance, AxiosResponse } from 'axios';
import type { 
  ApiResponse, 
  Participant, 
  ParticipantForm, 
  AdminLoginForm, 
  AdminAuthResponse, 
  DashboardStats, 
  ParticipantFilters,
  PaginatedResponse,
  TimelineStep 
} from '@/types';

class ApiService {
  private api: AxiosInstance;

  constructor() {
    this.api = axios.create({
      baseURL: 'http://127.0.0.1:8000/api',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
      },
    });

    // Request interceptor to add auth token
    this.api.interceptors.request.use(
      (config) => {
        const token = localStorage.getItem('admin_token');
        if (token) {
          config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
      },
      (error) => {
        return Promise.reject(error);
      }
    );

    // Response interceptor to handle errors
    this.api.interceptors.response.use(
      (response) => response,
      (error) => {
        if (error.response?.status === 401) {
          localStorage.removeItem('admin_token');
          localStorage.removeItem('admin_user');
          window.location.href = '/admin/login';
        }
        return Promise.reject(error);
      }
    );
  }

  // Registration endpoints
  async registerParticipant(formData: FormData): Promise<ApiResponse<Participant>> {
    const response: AxiosResponse<ApiResponse<Participant>> = await this.api.post('/registration/register', formData, {
      headers: {
        'Content-Type': 'multipart/form-data',
      },
    });
    return response.data;
  }

  async getFieldOfInterestOptions(): Promise<ApiResponse<Record<string, string>>> {
    const response: AxiosResponse<ApiResponse<Record<string, string>>> = await this.api.get('/registration/field-of-interest-options');
    return response.data;
  }

  async getRegistrationTypeOptions(): Promise<ApiResponse<Record<string, string>>> {
    const response: AxiosResponse<ApiResponse<Record<string, string>>> = await this.api.get('/registration/registration-type-options');
    return response.data;
  }

  // Admin authentication endpoints
  async adminLogin(credentials: AdminLoginForm): Promise<ApiResponse<AdminAuthResponse>> {
    const response: AxiosResponse<ApiResponse<AdminAuthResponse>> = await this.api.post('/admin/login', credentials);
    return response.data;
  }

  async adminLogout(): Promise<ApiResponse> {
    const response: AxiosResponse<ApiResponse> = await this.api.post('/admin/logout');
    return response.data;
  }

  async getAdminProfile(): Promise<ApiResponse<any>> {
    const response: AxiosResponse<ApiResponse<any>> = await this.api.get('/admin/profile');
    return response.data;
  }

  // Participant management endpoints
  async getParticipants(filters: ParticipantFilters = {}): Promise<ApiResponse<Participant[]>> {
    const response: AxiosResponse<ApiResponse<Participant[]>> = await this.api.get('/admin/participants', {
      params: filters,
    });
    return response.data;
  }

  async getParticipant(id: number): Promise<ApiResponse<Participant>> {
    const response: AxiosResponse<ApiResponse<Participant>> = await this.api.get(`/admin/participants/${id}`);
    return response.data;
  }

  async approveParticipant(id: number, evaluationData: { score: number; description: string }): Promise<ApiResponse<Participant>> {
    const response: AxiosResponse<ApiResponse<Participant>> = await this.api.post(`/admin/participants/${id}/approve`, evaluationData);
    return response.data;
  }

  async rejectParticipant(id: number): Promise<ApiResponse<Participant>> {
    const response: AxiosResponse<ApiResponse<Participant>> = await this.api.post(`/admin/participants/${id}/reject`);
    return response.data;
  }

  async downloadParticipantCv(id: number): Promise<Blob> {
    const response: AxiosResponse<Blob> = await this.api.get(`/admin/participants/${id}/cv`, {
      responseType: 'blob',
    });
    return response.data;
  }

  async exportParticipantsToExcel(filters: ParticipantFilters = {}): Promise<Blob> {
    const response: AxiosResponse<Blob> = await this.api.get('/admin/participants/export/excel', {
      params: filters,
      responseType: 'blob',
    });
    return response.data;
  }

  // Statistics and export endpoints
  async getStatistics(): Promise<ApiResponse<DashboardStats>> {
    const response: AxiosResponse<ApiResponse<DashboardStats>> = await this.api.get('/admin/dashboard/stats');
    return response.data;
  }

  async exportParticipants(): Promise<ApiResponse<{ download_url: string }>> {
    const response: AxiosResponse<ApiResponse<{ download_url: string }>> = await this.api.get('/admin/participants/export');
    return response.data;
  }

  // Dashboard endpoints
  async getDashboardStats(): Promise<ApiResponse<DashboardStats>> {
    const response: AxiosResponse<ApiResponse<DashboardStats>> = await this.api.get('/admin/dashboard/stats');
    return response.data;
  }

  // Timeline Steps endpoints (public)
  async getTimelineSteps(): Promise<ApiResponse<TimelineStep[]>> {
    const response: AxiosResponse<ApiResponse<TimelineStep[]>> = await this.api.get('/timeline-steps');
    return response.data;
  }

  // Admin Timeline Steps management endpoints
  async getAdminTimelineSteps(): Promise<ApiResponse<TimelineStep[]>> {
    const response: AxiosResponse<ApiResponse<TimelineStep[]>> = await this.api.get('/admin/timeline-steps');
    return response.data;
  }

  async createTimelineStep(stepData: Partial<TimelineStep>): Promise<ApiResponse<TimelineStep>> {
    const response: AxiosResponse<ApiResponse<TimelineStep>> = await this.api.post('/admin/timeline-steps', stepData);
    return response.data;
  }

  async getTimelineStep(id: number): Promise<ApiResponse<TimelineStep>> {
    const response: AxiosResponse<ApiResponse<TimelineStep>> = await this.api.get(`/admin/timeline-steps/${id}`);
    return response.data;
  }

  async updateTimelineStep(id: number, stepData: Partial<TimelineStep>): Promise<ApiResponse<TimelineStep>> {
    const response: AxiosResponse<ApiResponse<TimelineStep>> = await this.api.put(`/admin/timeline-steps/${id}`, stepData);
    return response.data;
  }

  async deleteTimelineStep(id: number): Promise<ApiResponse> {
    const response: AxiosResponse<ApiResponse> = await this.api.delete(`/admin/timeline-steps/${id}`);
    return response.data;
  }
}

export const apiService = new ApiService();
export default apiService; 