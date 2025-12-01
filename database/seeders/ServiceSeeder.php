<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['title' => 'Document Issuance Service', 'description' => 'Get your official documents electronically with ease and security. The service is available 24/7 and does not require visiting branches.'],
            ['title' => 'Electronic Bill Payment', 'description' => 'Pay all your government bills in a safe and fast way through our advanced electronic platform.'],
            ['title' => 'Electronic Appointment Booking', 'description' => 'Book your appointment with government agencies easily and choose the time that suits you without having to wait.'],
            ['title' => 'Commercial Establishment Registration', 'description' => 'Register your commercial establishment electronically and get all necessary licenses instantly and securely.'],
            ['title' => 'Request Inquiry Service', 'description' => 'Track the status of your requests and government transactions directly and get instant updates on the request status.'],
            ['title' => 'Education and Training Services', 'description' => 'Get information about available educational programs and training courses and register for them electronically.'],
            ['title' => 'Electronic Health Services', 'description' => 'Book your medical appointments and get health reports and medical prescriptions electronically with ease.'],
            ['title' => 'Traffic and Transportation Services', 'description' => 'Renew your driving license or issue a new one, track traffic violations and pay them electronically.'],
            ['title' => 'Real Estate Services', 'description' => 'Register your properties, verify ownership and get all necessary real estate certificates electronically.'],
            ['title' => 'Judicial Services', 'description' => 'Follow your cases, get legal information and submit requests and complaints electronically with security.'],
            ['title' => 'Passports and Civil Affairs Services', 'description' => 'Renew your passport, issue national ID card, and get all civil documents.'],
            ['title' => 'Employment and HR Services', 'description' => 'Search for available jobs in the government sector and submit your applications electronically and track your application status.'],
            ['title' => 'Business License Services', 'description' => 'Apply for and renew business licenses for various commercial activities through our streamlined digital process.'],
            ['title' => 'Tax and Zakat Services', 'description' => 'File your tax returns, pay zakat, and manage all your tax-related matters online.'],
            ['title' => 'Building Permits', 'description' => 'Apply for construction permits, track your application progress, and receive approvals digitally.'],
            ['title' => 'Visa and Residency Services', 'description' => 'Process visa applications, renew residency permits, and manage all immigration-related services.'],
            ['title' => 'Social Services', 'description' => 'Access social welfare programs, apply for benefits, and manage your social security information.'],
            ['title' => 'Environmental Permits', 'description' => 'Obtain environmental clearances and permits required for business operations and construction projects.'],
            ['title' => 'Customs and Trade Services', 'description' => 'Clear customs, pay duties, and manage import/export documentation electronically.'],
            ['title' => 'Municipal Services', 'description' => 'Request municipal services, report issues, and manage property-related municipal matters online.'],
        ];

        foreach ($services as $index => $service) {
            Service::create([
                'title' => $service['title'],
                'title_ar' => $service['title'],
                'description' => $service['description'],
                'description_ar' => $service['description'],
                'order' => $index + 1,
                'is_active' => $index % 3 !== 0, // Make every 3rd service inactive for variety
            ]);
        }
    }
}
