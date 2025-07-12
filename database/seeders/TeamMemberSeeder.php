<?php

namespace Database\Seeders;

use App\Models\TeamMember;
use Illuminate\Database\Seeder;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamMembers = [
            [
                'name' => 'Wendy Tri Prabowo',
                'position' => 'Director of the Shrimp Breeding Center (BPIU2K)',
                'bio' => 'Bringing over 20 years of expertise in shrimp breeding. His work has focused on developing high-performance shrimp strains through selective breeding and combining ability analysis. Wendy has been instrumental in designing and implementing shrimp hatcheries and farm operations across Indonesia, ensuring efficient and sustainable aquaculture systems. He previously collaborated with Dr. John Liu at the School of Fisheries, Auburn University, where he contributed to genome editing analysis aimed at improving fish genetics. His leadership in integrating advanced biotechnological approaches with practical breeding strategies continues to drive innovation in Indonesia\'s shrimp aquaculture sector.',
                'avatar' => null,
                'order' => 1,
                'social_links' => [
                    'linkedin' => '#',
                    'twitter' => '#',
                    'email' => 'wendy@example.com'
                ],
                'skills' => [
                    'Shrimp Breeding',
                    'Hatchery Design',
                    'Genome Editing Analysis',
                    'Sustainable Aquaculture'
                ],
                'is_active' => true,
                'user_id' => null
            ],
            [
                'name' => 'Bagus Rahmat Basuki',
                'position' => 'Coordinator of the Molecular and Biotechnology Laboratory',
                'bio' => 'With over 16 years of dedicated experience in shrimp breeding. He has been actively involved in genetic research and development, with a particular focus on disease-resistant shrimp strains. His earlier work with Professor Alimudin at IPB University (Bogor Agricultural University) centered on identifying SNP markers associated with resistance to White Spot Syndrome Virus (WSSV). Bagus is deeply interested in the mechanisms of shrimp adaptation to environmental stressors and has led numerous challenge tests to evaluate disease resistance and tolerance to fluctuating aquaculture conditions. His contributions are critical to advancing sustainable breeding programs aimed at developing robust, high-performing shrimp strains for Indonesia\'s aquaculture industry.',
                'avatar' => null,
                'order' => 2,
                'social_links' => [
                    'linkedin' => '#',
                    'researchgate' => '#',
                    'email' => 'bagus@example.com'
                ],
                'skills' => [
                    'Genetic Research',
                    'Disease Resistance',
                    'SNP Markers Analysis',
                    'Environmental Stress Adaptation'
                ],
                'is_active' => true,
                'user_id' => null
            ],
            [
                'name' => 'M. Suyuti',
                'position' => 'Coordinator of the Broodstock Center',
                'bio' => 'Bringing over 23 years of hands-on experience in hatchery management and grow-out operations. A fish nutritionist by training from Brawijaya University, he specializes in developing efficient and sustainable aquaculture systems. Suyuti plays a crucial role in the success of shrimp breeding programs by ensuring optimal broodstock conditioning and larval rearing practices. Beyond technical operations, he is also deeply involved in community outreach, providing technical guidance and training to local farmers to improve their farming practices. His expertise bridges scientific innovation and practical implementation, supporting the broader goal of strengthening Indonesia\'s shrimp aquaculture sector from the ground up.',
                'avatar' => null,
                'order' => 3,
                'social_links' => [
                    'linkedin' => '#',
                    'email' => 'suyuti@example.com'
                ],
                'skills' => [
                    'Hatchery Management',
                    'Fish Nutrition',
                    'Broodstock Conditioning',
                    'Community Outreach'
                ],
                'is_active' => true,
                'user_id' => null
            ],
            [
                'name' => 'Faisal Ramadhan',
                'position' => 'Coordinator of Public Services and Quality Control',
                'bio' => 'With 17 years of experience in shrimp breeding programs. His work bridges technical excellence with community engagement, making him a key figure in ensuring both the quality and accessibility of breeding innovations. Faisal specializes in community empowerment and network development, actively facilitating partnerships between research institutions, hatcheries, and local farmer groups. His efforts are focused on building inclusive, sustainable breeding ecosystems that support capacity building and knowledge transfer across regions. Through his leadership, the breeding program not only meets high technical standards but also reaches and benefits broader aquaculture communities throughout Indonesia.',
                'avatar' => null,
                'order' => 4,
                'social_links' => [
                    'linkedin' => '#',
                    'facebook' => '#',
                    'email' => 'faisal@example.com'
                ],
                'skills' => [
                    'Quality Control',
                    'Community Empowerment',
                    'Network Development',
                    'Capacity Building'
                ],
                'is_active' => true,
                'user_id' => null
            ],
            [
                'name' => 'Ni Luh Eka S.J.W',
                'position' => 'Human Resources Coordinator',
                'bio' => 'With 17 years of experience supporting shrimp breeding programs through strategic HR and business process management. Her expertise lies in aligning human capital development with the technical demands of aquaculture operations. Ni Luh plays a vital role in designing organizational structures, optimizing workflows, and cultivating a skilled workforce to support innovation in shrimp genetics and hatchery management. Her leadership ensures that the breeding program operates with strong institutional capacity, fostering a professional, adaptive, and performance-driven environment critical to the long-term success of sustainable aquaculture initiatives.',
                'avatar' => null,
                'order' => 5,
                'social_links' => [
                    'linkedin' => '#',
                    'email' => 'ni.luh@example.com'
                ],
                'skills' => [
                    'HR Management',
                    'Business Process Optimization',
                    'Organizational Development',
                    'Workforce Training'
                ],
                'is_active' => true,
                'user_id' => null
            ]
        ];

        foreach ($teamMembers as $member) {
            TeamMember::create($member);
        }
    }
}
