// API Response Types
export interface ApiResponse<T = any> {
  success: boolean;
  message?: string;
  data?: T;
  error?: string;
}

// Team Member Types
export interface TeamMember {
  id: number;
  participant_id: number;
  name: string;
  created_at: string;
  updated_at: string;
}

// Evaluation Types
export interface Evaluation {
  id: number;
  participant_id: number;
  admin_id: number;
  score: number;
  description: string;
  created_at: string;
  updated_at: string;
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
  registration_type: 'Individual' | 'Team' | 'Organization';
  cv_path?: string;
  project_idea?: string;
  status: 'Pending' | 'Approved' | 'Rejected';
  terms_accepted: boolean;
  team_members?: TeamMember[];
  evaluation?: Evaluation;
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
  registration_type: 'Individual' | 'Team' | 'Organization';
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
  { value: 'SmartMonitoring', label: 'Smart Monitoring of Services and Facilities', label_ar: 'المتابعة الذكية للخدمات والمرافق' },
  { value: 'InteractiveTourism', label: 'Interactive Religious Tourism', label_ar: 'السياحة الدينية التفاعلية' },
  { value: 'SmartMobility', label: 'Smart Mobility and Sustainable Transport', label_ar: 'النقل الذكي والتنقل المستدام' },
  { value: 'DigitalHealthcare', label: 'Digital Healthcare', label_ar: 'الرعاية الصحية الرقمية' },
  { value: 'EnvironmentalTech', label: 'Environmental Technology', label_ar: 'التقنية البيئية' },
  { value: 'SmartInfrastructure', label: 'Smart Infrastructure', label_ar: 'البنى التحتية الذكية' },
  { value: 'Other', label: 'Other', label_ar: 'أخرى' },
];


export const REGISTRATION_TYPE_OPTIONS = [
  { value: 'Individual', label: 'Individual', label_ar: 'فردي' },
  { value: 'Team', label: 'Team', label_ar: 'فريق' },
  { value: 'Organization', label: 'Organization', label_ar: 'منظمة' },
];

export const STATUS_OPTIONS = [
  { value: 'Pending', label: 'Pending', label_ar: 'قيد المراجعة' },
  { value: 'Approved', label: 'Approved', label_ar: 'مقبول' },
  { value: 'Rejected', label: 'Rejected', label_ar: 'مرفوض' },
];

// Timeline Step Types
export interface TimelineStep {
  id: number;
  title_ar: string;
  title_en: string;
  subtitle_ar?: string;
  subtitle_en?: string;
  description_ar?: string;
  description_en?: string;
  step_date?: string;
  order: number;
  is_active: boolean;
  created_at: string;
  updated_at: string;
} 