export interface Teacher {
    id: number;
    name: string;
    personnel_number: string;
    email: string;
    cnic: string;
    phone_number: string;
    bank_iban: string;
    isMale: boolean;
    date_of_birth: string;
    date_of_joining_in_this_college: string;
    date_of_joining_govt_service: string;
    date_of_joining_current_rank: string;
    father_name: string;
    seniority_number: number;
    qualification: string;
    highest_degree_awarding_institute: string;
    highest_degree_awarding_country: string;
    highest_degree_awarding_year: number;
    degree_title: string;
    rank: string;
    position: string;
    department_id: number;
    isvisiting: boolean;
    isActive: boolean;
    created_at: string;
    updated_at: string;
}

export interface Department {
    id: number;
    name: string;
    code: string;
    created_at: string;
    updated_at: string;
}

export interface Instituion {
    id: number;
    name: string;
    email: string;
    address: string;
    phone: string;
    created_at: string;
    updated_at: string;
}