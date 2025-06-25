// API Response Types
export interface ApiResponse<T = any> {
  success: boolean;
  message?: string;
  data?: T;
  error?: string;
}

// Participant Types
export interface Participant {
  id: number;
  full_name: string;
  email: string;
  phone: string;
  age: number;
  city: string;
  field_of_interest: string;
  registration_type: 'Individual' | 'Team';
  cv_path?: string;
  project_idea?: string;
  status: 'Pending' | 'Approved' | 'Rejected';
  terms_accepted: boolean;
  created_at: string;
  updated_at: string;
}

export interface ParticipantForm {
  full_name: string;
  email: string;
  phone: string;
  age: number;
  city: string;
  field_of_interest: string;
  registration_type: 'Individual' | 'Team';
  cv: File | null;
  project_idea: string;
  terms_accepted: boolean;
}

// Admin Types
export interface Admin {
  id: number;
  name: string;
  email: string;
  created_at: string;
  updated_at: string;
}

export interface AdminLoginForm {
  email: string;
  password: string;
}

export interface AdminAuthResponse {
  admin: Admin;
  token: string;
}

// Dashboard Types
export interface DashboardStats {
  total_participants: number;
  pending_participants: number;
  approved_participants: number;
  rejected_participants: number;
  individual_participants: number;
  team_participants: number;
  field_of_interest_stats: Record<string, number>;
  recent_registrations: Participant[];
}

// Filter Types
export interface ParticipantFilters {
  registration_type?: string;
  status?: string;
  field_of_interest?: string;
  search?: string;
  sort_by?: string;
  sort_order?: 'asc' | 'desc';
  per_page?: number;
}

// Pagination Types
export interface PaginatedResponse<T> {
  data: T[];
  current_page: number;
  last_page: number;
  per_page: number;
  total: number;
  from: number;
  to: number;
}

// Form Validation Types
export interface FormErrors {
  [key: string]: string[];
}

// Language Types
export type Language = 'en' | 'ar';

// Component Props Types
export interface ButtonProps {
  type?: 'button' | 'submit' | 'reset';
  variant?: 'primary' | 'secondary' | 'accent' | 'outline';
  size?: 'sm' | 'md' | 'lg';
  disabled?: boolean;
  loading?: boolean;
}

export interface InputProps {
  type?: string;
  placeholder?: string;
  disabled?: boolean;
  error?: string;
  required?: boolean;
}

export interface SelectProps {
  options: Array<{ value: string; label: string }>;
  placeholder?: string;
  disabled?: boolean;
  error?: string;
  required?: boolean;
}

// Event Types
export interface TimelineEvent {
  id: number;
  title: string;
  title_ar: string;
  description: string;
  description_ar: string;
  date: string;
  time?: string;
  location?: string;
  location_ar?: string;
}

export interface FAQ {
  id: number;
  question: string;
  question_ar: string;
  answer: string;
  answer_ar: string;
  category?: string;
}

// Field Options
export const FIELD_OF_INTEREST_OPTIONS = [
  { value: 'AI', label: 'Artificial Intelligence', label_ar: 'الذكاء الاصطناعي' },
  { value: 'Web Development', label: 'Web Development', label_ar: 'تطوير الويب' },
  { value: 'IoT', label: 'Internet of Things', label_ar: 'إنترنت الأشياء' },
  { value: 'Mobile Development', label: 'Mobile Development', label_ar: 'تطوير التطبيقات' },
  { value: 'Data Science', label: 'Data Science', label_ar: 'علم البيانات' },
  { value: 'Cybersecurity', label: 'Cybersecurity', label_ar: 'الأمن السيبراني' },
  { value: 'Blockchain', label: 'Blockchain', label_ar: 'بلوك تشين' },
  { value: 'Other', label: 'Other', label_ar: 'أخرى' },
];

export const REGISTRATION_TYPE_OPTIONS = [
  { value: 'Individual', label: 'Individual', label_ar: 'فردي' },
  { value: 'Team', label: 'Team', label_ar: 'فريق' },
];

export const STATUS_OPTIONS = [
  { value: 'Pending', label: 'Pending', label_ar: 'قيد المراجعة' },
  { value: 'Approved', label: 'Approved', label_ar: 'مقبول' },
  { value: 'Rejected', label: 'Rejected', label_ar: 'مرفوض' },
]; 