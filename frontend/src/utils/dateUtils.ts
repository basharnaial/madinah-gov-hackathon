// Date formatting utilities for Arabic and English with Hijri support

// Arabic month names
const arabicMonths = [
  'يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو',
  'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'
];

// English month names
const englishMonths = [
  'January', 'February', 'March', 'April', 'May', 'June',
  'July', 'August', 'September', 'October', 'November', 'December'
];

// Arabic Hijri month names
const hijriMonths = [
  'محرم', 'صفر', 'ربيع الأول', 'ربيع الثاني', 'جمادى الأولى', 'جمادى الثانية',
  'رجب', 'شعبان', 'رمضان', 'شوال', 'ذو القعدة', 'ذو الحجة'
];

/**
 * Convert Gregorian date to Hijri date (simplified calculation)
 * Note: This is an approximation. For precise calculations, consider using a proper Hijri calendar library
 */
function gregorianToHijri(gregorianDate: Date): { year: number; month: number; day: number } {
  // Simple conversion (approximation)
  // Hijri calendar started on July 16, 622 CE
  const hijriEpoch = new Date(622, 6, 16);
  const daysDiff = Math.floor((gregorianDate.getTime() - hijriEpoch.getTime()) / (1000 * 60 * 60 * 24));
  
  // Average Hijri year is about 354.37 days
  const hijriYear = Math.floor(daysDiff / 354.37) + 1;
  const remainingDays = daysDiff % 354.37;
  
  // Average Hijri month is about 29.53 days
  const hijriMonth = Math.floor(remainingDays / 29.53) + 1;
  const hijriDay = Math.floor(remainingDays % 29.53) + 1;
  
  return {
    year: Math.max(1, hijriYear),
    month: Math.min(12, Math.max(1, hijriMonth)),
    day: Math.min(30, Math.max(1, hijriDay))
  };
}

/**
 * Format date in Arabic style (e.g., "13 يونيو 2025")
 */
export function formatDateArabic(dateString: string): string {
  try {
    const date = new Date(dateString);
    if (isNaN(date.getTime())) return dateString;
    
    const day = date.getDate();
    const month = arabicMonths[date.getMonth()];
    const year = date.getFullYear();
    
    return `${day} ${month} ${year}`;
  } catch (error) {
    return dateString;
  }
}

/**
 * Format date in English style (e.g., "June 13, 2025")
 */
export function formatDateEnglish(dateString: string): string {
  try {
    const date = new Date(dateString);
    if (isNaN(date.getTime())) return dateString;
    
    const day = date.getDate();
    const month = englishMonths[date.getMonth()];
    const year = date.getFullYear();
    
    return `${month} ${day}, ${year}`;
  } catch (error) {
    return dateString;
  }
}

/**
 * Format Hijri date in Arabic style (e.g., "15 رجب 1446")
 */
export function formatHijriDate(dateString: string): string {
  try {
    const date = new Date(dateString);
    if (isNaN(date.getTime())) return '';
    
    const hijri = gregorianToHijri(date);
    const monthName = hijriMonths[hijri.month - 1];
    
    return `${hijri.day} ${monthName} ${hijri.year}`;
  } catch (error) {
    return '';
  }
}

/**
 * Format date with both Gregorian and Hijri dates
 */
export function formatDateWithHijri(dateString: string, language: 'ar' | 'en'): {
  gregorian: string;
  hijri: string;
} {
  const gregorian = language === 'ar' 
    ? formatDateArabic(dateString)
    : formatDateEnglish(dateString);
  
  const hijri = formatHijriDate(dateString);
  
  return { gregorian, hijri };
}

/**
 * Get day name in Arabic
 */
export function getDayNameArabic(dateString: string): string {
  const arabicDays = ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];
  try {
    const date = new Date(dateString);
    return arabicDays[date.getDay()];
  } catch {
    return '';
  }
}

/**
 * Get day name in English
 */
export function getDayNameEnglish(dateString: string): string {
  const englishDays = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
  try {
    const date = new Date(dateString);
    return englishDays[date.getDay()];
  } catch {
    return '';
  }
} 