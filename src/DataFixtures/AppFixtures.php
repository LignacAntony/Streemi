<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Episode;
use App\Entity\Language;
use App\Entity\Movie;
use App\Entity\Playlist;
use App\Entity\PlaylistMedia;
use App\Entity\PlaylistSubscription;
use App\Entity\Season;
use App\Entity\Serie;
use App\Entity\Subscription;
use App\Entity\SubscriptionHistory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\WatchHistory;
use App\Enum\AccountStatusEnum;
use App\Enum\CommentStatusEnum;
use App\Enum\MediaTypeEnum;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager,): void
    {
        $subscriptions = [
            ['name' => 'Basic', 'price' => 30, 'duration' => 6],
            ['name' => 'Premium', 'price' => 50, 'duration' => 12],
            ['name' => 'VIP', 'price' => 90, 'duration' => 24],
        ];

        foreach ($subscriptions as $index => $subData) {
            $subscription = new Subscription();
            $subscription->setName($subData['name']);
            $subscription->setPrice($subData['price']);
            $subscription->setDurationInMonth($subData['duration']);
            $subscription->setDescription('This is a ' . $subData['name'] . ' subscription');
            $manager->persist($subscription);
            $this->addReference('subscription_' . $index, $subscription);
        }
        $category1 = new Category();
        $category1->setName('Action');
        $category1->setLabel('Action');
        $manager->persist($category1);

        $category2 = new Category();
        $category2->setName('Adventure');
        $category2->setLabel('Adventure');
        $manager->persist($category2);

        $category3 = new Category();
        $category3->setName('Comedy');
        $category3->setLabel('Comedy');
        $manager->persist($category3);

        $category4 = new Category();
        $category4->setName('Crime');
        $category4->setLabel('Crime');
        $manager->persist($category4);

        $category5 = new Category();
        $category5->setName('Drama');
        $category5->setLabel('Drama');
        $manager->persist($category5);

        $category6 = new Category();
        $category6->setName('Fantasy');
        $category6->setLabel('Fantasy');
        $manager->persist($category6);

        $language1 = new Language();
        $language1->setName('English');
        $language1->setCode('en');
        $manager->persist($language1);

        $language2 = new Language();
        $language2->setName('French');
        $language2->setCode('fr');
        $manager->persist($language2);

        $language3 = new Language();
        $language3->setName('Spanish');
        $language3->setCode('es');
        $manager->persist($language3);

        $film1 = new Movie();
        $film1->setMediaType(MediaTypeEnum::MOVIE);
        $film1->setTitle('The Godfather');
        $film1->setShortDescription('The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.');
        $film1->setLongDescription('The Godfather "Don" Vito Corleone is the head of the Corleone mafia family in New York. He is at the event of his daughter\'s wedding. Michael, Vito\'s youngest son and a decorated WWII Marine is also present at the wedding. Michael seems to be uninterested in being a part of the family business. Vito is a powerful man, and is kind to all those who give him respect but is ruthless against those who do not. But when a powerful and treacherous rival wants to sell drugs and needs the Don\'s influence for the same, Vito refuses to do it. What follows is a clash between Vito\'s fading old values and the new ways which may cause Michael to do the thing he was most reluctant in doing and wage a mob war against all the other mafia families which could tear the Corleone family apart.');
        $film1->setReleasedDateAt(new \DateTime('1972-03-24'));
        $film1->setCoverImage('https://communist.red/wp-content/uploads/2022/08/godfather.png.webp');
        $film1->setStaff([
            'Director' => ['name' => 'Francis Ford Coppola', 'photo' => 'https://img-4.linternaute.com/Irzs1MQwmac-88sLIBwEclZ2aHg=/1500x/smart/16a504f76f2549bb846c68fd00d8f5c1/ccmcms-linternaute/23801388.jpg'],
            'Writer' => ['name' => 'Mario Puzo', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/4/48/Mario_Puzo_1972_%28cropped%29.jpg'],
            'Producer' => ['name' => 'Albert S. Ruddy', 'photo' => 'https://9b16f79ca967fd0708d1-2713572fef44aa49ec323e813b06d2d9.ssl.cf2.rackcdn.com/1140x_a10-7_cTC/Obit-Albert-Ruddy-1-1716925170.jpg']
        ]);
        $film1->setCasting([
            ['name' => 'Marlon Brando', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/5/53/Marlon_Brando_publicity_for_One-Eyed_Jacks.png'],
            ['name' => 'Al Pacino', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/3/3e/Al_Pacino_2016_%2830401544240%29.jpg'],
            ['name' => 'James Caan', 'photo' => 'https://images.mubicdn.net/images/cast_member/4960/cache-645-1376242422/image-w856.jpg'],
            ['name' => 'Richard S. Castellano', 'photo' => 'https://fr.web.img6.acsta.net/pictures/19/09/24/19/54/5682825.jpg'],
            ['name' => 'Robert Duvall', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/e/ea/Robert_Duvall_2_by_David_Shankbone_%28cropped%29.jpg'],
            ['name' => 'Sterling Hayden', 'photo' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTIlwqJnHD9X-yWGFQGjq2ILIg2mJnnWXJ6sw&s'],
            ['name' => 'John Marley', 'photo' => 'https://images.mubicdn.net/images/cast_member/10181/cache-655-1478101707/image-w856.jpg'],
            ['name' => 'Richard Conte', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/b/b0/Richard_Conte_1945.JPG'],
            ['name' => 'Al Lettieri', 'photo' => 'https://media.themoviedb.org/t/p/w500/fE5mEWPkkVJlCji0EoKht8PYw89.jpg'],
            ['name' => 'Diane Keaton', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/b/bf/Diane_Keaton_2012-1_%28cropped%29.jpg/640px-Diane_Keaton_2012-1_%28cropped%29.jpg']
        ]);
        $film1->addCategory($category4);
        $film1->addCategory($category5);
        $film1->addLanguage($language1);
        $film1->addLanguage($language2);
        $film1->setDuration(175);
        $manager->persist($film1);

        $film2 = new Movie();
        $film2->setMediaType(MediaTypeEnum::MOVIE);
        $film2->setTitle('The Shawshank Redemption');
        $film2->setShortDescription('Two imprisoned');
        $film2->setLongDescription('A banker convicted of uxoricide forms a friendship over a quarter century with a hardened convict, while maintaining his innocence and trying to remain hopeful through simple compassion.');
        $film2->setReleasedDateAt(new \DateTime('1994-09-23'));
        $film2->setCoverImage('https://www.cinematheque.qc.ca/cdn-cgi/image/format=auto/workspace/uploads/projections/grm_shawshank_banner-fr-1708112598.jpeg');
        $film2->setStaff([
            'Director' => ['name' => 'Frank Darabont', 'photo' => 'https://img-4.linternaute.com/Gc5nFZmCNAWKdyc69K0ij8_9gyk=/1240x/smart/ab0a98b90cdc449c825e2c4ce7cc1127/ccmcms-linternaute/10161402-14-frank-darabont.jpg'],
            'Writer' => ['name' => 'Stephen King', 'photo' => 'https://media.vanityfair.fr/photos/60d36a19054484c84ef3f8be/16:9/w_2560%2Cc_limit/vf_stephen_king_8343.jpeg'],
            'Producer' => ['name' => 'Niki Marvin', 'photo' => 'https://images.mubicdn.net/images/cast_member/23718/cache-209048-1489646455/image-w856.jpg']
        ]);
        $film2->setCasting([
            ['name' => 'Tim Robbins', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/9/96/TimRobbins08TIFF.jpg'],
            ['name' => 'Morgan Freeman', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/e/e4/Morgan_Freeman_Deauville_2018.jpg'],
            ['name' => 'Bob Gunton', 'photo' => 'https://images.mubicdn.net/images/cast_member/23719/cache-70952-1360854490/image-w856.jpg'],
            ['name' => 'William Sadler', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ae/William_Sadler_2019.jpg/800px-William_Sadler_2019.jpg'],
            ['name' => 'Clancy Brown', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/39/Clancy_Brown_by_Gage_Skidmore.jpg/1200px-Clancy_Brown_by_Gage_Skidmore.jpg'],
            ['name' => 'Gil Bellows', 'photo' => 'https://resize-elle.ladmedia.fr/rcrop/638,,forcex/img/var/plain_site/storage/images/loisirs/series/ally-mcbeal/gil-bellows-aujourd-hui/53999858-1-fre-FR/Gil-Bellows-aujourd-hui.jpg'],
            ['name' => 'Mark Rolston', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/9/97/Mark_Rolston_Comic_Con_2023_%28cropped%29.jpg']
        ]);
        $film2->addCategory($category5);
        $film2->addCategory($category6);
        $film2->addLanguage($language1);
        $film2->addLanguage($language2);
        $film2->setDuration(142);
        $manager->persist($film2);

        $serie1 = new Serie();
        $serie1->setMediaType(MediaTypeEnum::SERIE);
        $serie1->setTitle('Breaking Bad');
        $serie1->setShortDescription('A high school chemistry teacher turned meth maker.');
        $serie1->setLongDescription('Walter White, a high school chemistry teacher, turned meth maker, teams up with a former student, Jesse Pinkman, to create and sell blue meth.');
        $serie1->setReleasedDateAt(new \DateTime('2008-01-20'));
        $serie1->setCoverImage('https://www.lorhkan.com/wp-content/uploads/2014/01/Breaking-Bad-2.jpg');
        $serie1->setStaff([
            'Creator and Writer' => ['name' => 'Vince Gilligan', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/e/e2/Vince_Gilligan_by_Gage_Skidmore_3.jpg'],
            'Producer' => ['name' => 'Mark Johnson', 'photo' => 'https://static.wikia.nocookie.net/lemondededisney/images/2/20/Mark_Johnson.jpg/revision/latest?cb=20200411105018&path-prefix=fr'],
        ]);
        $serie1->setCasting([
            ['name' => 'Bryan Cranston', 'photo' => 'https://lvdneng.rosselcdn.net/sites/default/files/dpistyles_v2/vdn_864w/2023/06/09/node_1338386/56282676/public/2023/06/09/B9734486000Z.1_20230609193750_000%2BGOLMU8QVH.1-0.jpg?itok=RwKTGxLN1686332276'],
            ['name' => 'Aaron Paul', 'photo' => 'https://img.20mn.fr/cHk0PFJjQRS5XZ6WdQedZg/1444x920_acteur-americain-aaron-paul-premiere-film-exodus-8-decembre-2014'],
            ['name' => 'Anna Gunn', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Anna_Gunn_by_Gage_Skidmore_3.jpg/800px-Anna_Gunn_by_Gage_Skidmore_3.jpg'],
            ['name' => 'Betsy Brandt', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/8/80/Betsy_Brandt_by_Gage_Skidmore_2.jpg'],
            ['name' => 'Dean Norris', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/b/bf/Dean_Norris_by_Gage_Skidmore_3.jpg'],
            ['name' => 'RJ Mitte', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/RJ_Mitte_by_Gage_Skidmore.jpg/1200px-RJ_Mitte_by_Gage_Skidmore.jpg'],
            ['name' => 'Bob Odenkirk', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cb/Bob_Odenkirk_by_Gage_Skidmore_2.jpg/800px-Bob_Odenkirk_by_Gage_Skidmore_2.jpg'],
            ['name' => 'Jonathan Banks', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a7/Jonathan_Banks_by_Gage_Skidmore.jpg/1200px-Jonathan_Banks_by_Gage_Skidmore.jpg'],
            ['name' => 'Giancarlo Esposito', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/94/Giancarlo_Esposito_by_Gage_Skidmore_3.jpg/1200px-Giancarlo_Esposito_by_Gage_Skidmore_3.jpg'],
            ['name' => 'Steven Michael Quezada', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/22/Steven_Michael_Quezada_by_Gage_Skidmore.jpg/1200px-Steven_Michael_Quezada_by_Gage_Skidmore.jpg']
        ]);
        $serie1->addCategory($category4);
        $serie1->addCategory($category2);
        $serie1->addLanguage($language1);
        $serie1->addLanguage($language3);
        $manager->persist($serie1);

        $season1 = new Season();
        $season1->setSerie($serie1);
        $season1->setSeasonNumber(1);
        $manager->persist($season1);

        $episode1 = new Episode();
        $episode1->setSeason($season1);
        $episode1->setTitle('Pilot');
        $episode1->setDuration(new \DateTime('00:58:00'));
        $episode1->setRealisedDateAt(new \DateTime('2008-01-20'));
        $manager->persist($episode1);

        $episode2 = new Episode();
        $episode2->setSeason($season1);
        $episode2->setTitle('Cat\'s in the Bag...');
        $episode2->setDuration(new \DateTime('00:48:00'));
        $episode2->setRealisedDateAt(new \DateTime('2008-01-27'));
        $manager->persist($episode2);


        $season2 = new Season();
        $season2->setSerie($serie1);
        $season2->setSeasonNumber(2);
        $manager->persist($season2);

        $episode3 = new Episode();
        $episode3->setSeason($season2);
        $episode3->setTitle('Seven Thirty-Seven');
        $episode3->setDuration(new \DateTime('00:48:00'));
        $episode3->setRealisedDateAt(new \DateTime('2009-03-08'));
        $manager->persist($episode3);

        $episode4 = new Episode();
        $episode4->setSeason($season2);
        $episode4->setTitle('Grilled');
        $episode4->setDuration(new \DateTime('00:48:00'));
        $episode4->setRealisedDateAt(new \DateTime('2009-03-15'));
        $manager->persist($episode4);


        $serie2 = new Serie();
        $serie2->setMediaType(MediaTypeEnum::SERIE);
        $serie2->setTitle('Game of Thrones');
        $serie2->setShortDescription('Nine noble families fight for control over the lands of Westeros, while an ancient enemy returns after being dormant for millennia.');
        $serie2->setLongDescription('In the mythical continent of Westeros, several powerful families fight for control of the Seven Kingdoms. As conflict erupts in the kingdoms of men, an ancient enemy rises once again to threaten them all. Meanwhile, the last heirs of a recently usurped dynasty plot to take back their homeland from across the Narrow Sea.');
        $serie2->setReleasedDateAt(new \DateTime('2011-04-17'));
        $serie2->setCoverImage('https://www.usatoday.com/gcdn/presto/2019/05/20/USAT/f44641fc-5482-4553-ba82-5f105f052391-AP_Game_of_Thrones_Economics_Confidence_Matters.JPG');
        $serie2->setStaff([
            'Creator' => ['name' => 'David Benioff', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/David_Benioff_by_Gage_Skidmore.jpg/440px-David_Benioff_by_Gage_Skidmore.jpg'],
            'Writer' => ['name' => 'George R. R. Martin', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/16/George_R._R._Martin_by_Gage_Skidmore_2.jpg/1200px-George_R._R._Martin_by_Gage_Skidmore_2.jpg'],
            'Producer' => ['name' => 'David Benioff', 'photo' => 'https://images.mubicdn.net/images/cast_member/17009/cache-242884-1501551087/image-w856.jpg']
        ]);
        $serie2->setCasting([
            ['name' => 'Emilia Clarke', 'photo' => 'https://static.wikia.nocookie.net/marvelstudios/images/f/f9/Emilia_Clarke.jpg/revision/latest?cb=20211113110428&path-prefix=fr'],
            ['name' => 'Peter Dinklage', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a4/Peter_Dinklage-34.jpg/1200px-Peter_Dinklage-34.jpg'],
            ['name' => 'Kit Harington', 'photo' => 'https://static.wikia.nocookie.net/game-of-thrones-le-trone-de-fer/images/3/34/Kit_Harington.png/revision/latest?cb=20161028115348&path-prefix=fr'],
            ['name' => 'Lena Headey', 'photo' => 'https://fr.web.img6.acsta.net/pictures/17/07/13/11/36/018746.jpg'],
            ['name' => 'Sophie Turner', 'photo' => 'https://media.vanityfair.com/photos/65244b0fa7e806ff0f80857d/master/pass/sophie-turner.jpg'],
            ['name' => 'Maisie Williams', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/f/fa/Maisie_Williams_by_Gage_Skidmore_3.jpg'],
            ['name' => 'Nikolaj Coster-Waldau', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/9/92/Nikolaj_Coster-Waldau-68363.jpg'],
            ['name' => 'Iain Glen', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/5/57/Iain_Glen.jpg'],
            ['name' => 'Alfie Allen', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Alfie_Allen_by_Gage_Skidmore_2.jpg/1200px-Alfie_Allen_by_Gage_Skidmore_2.jpg'],
            ['name' => 'John Bradley', 'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/John_Bradley_by_Gage_Skidmore_3.jpg/1200px-John_Bradley_by_Gage_Skidmore_3.jpg']
        ]);
        $serie2->addCategory($category1);
        $serie2->addCategory($category2);
        $serie2->addLanguage($language1);
        $serie2->addLanguage($language2);
        $manager->persist($serie2);

        $season3 = new Season();
        $season3->setSerie($serie2);
        $season3->setSeasonNumber(1);
        $manager->persist($season3);

        $episode5 = new Episode();
        $episode5->setSeason($season3);
        $episode5->setTitle('Winter Is Coming');
        $episode5->setDuration(new \DateTime('00:58:00'));
        $episode5->setRealisedDateAt(new \DateTime('2011-04-17'));
        $manager->persist($episode5);

        $episode6 = new Episode();
        $episode6->setSeason($season3);
        $episode6->setTitle('The Kingsroad');
        $episode6->setDuration(new \DateTime('00:58:00'));
        $episode6->setRealisedDateAt(new \DateTime('2011-04-24'));
        $manager->persist($episode6);

        $episode7 = new Episode();
        $episode7->setSeason($season3);
        $episode7->setTitle('Lord Snow');
        $episode7->setDuration(new \DateTime('00:58:00'));
        $episode7->setRealisedDateAt(new \DateTime('2011-05-01'));
        $manager->persist($episode7);

        $user1 = new User();
        $user1->setUsername('Anto');
        $user1->setEmail('anto@exmple.com');
        $user1->setPassword(
            $this->passwordHasher->hashPassword(
                $user1,
                "password"
            )
        );
        $user1->setRoles(['ROLE_ADMIN']);
        $user1->setAccountStatusEnum(AccountStatusEnum::ACTIVE);
        $subscription = $this->getReference('subscription_2');
        $user1->setCurrentSubscribtion($subscription);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('John');
        $user2->setEmail('john@exmple.com');
        $user2->setPassword(
            $this->passwordHasher->hashPassword(
                $user1,
                "password"
            )
        );
        $user2->setRoles(['ROLE_USER']);
        $user2->setAccountStatusEnum(AccountStatusEnum::ACTIVE);
        $subscription = $this->getReference('subscription_0');
        $user2->setCurrentSubscribtion($subscription);
        $manager->persist($user2);

        $user3 = new User();
        $user3->setUsername('Jane');
        $user3->setEmail('jane@exemple.com');
        $user3->setPassword(
            $this->passwordHasher->hashPassword(
                $user1,
                "password"
            )
        );
        $user3->setRoles(['ROLE_USER']);
        $user3->setAccountStatusEnum(AccountStatusEnum::ACTIVE);
        $subscription = $this->getReference('subscription_1');
        $user3->setCurrentSubscribtion($subscription);
        $manager->persist($user3);

        $subscriptionHistory1 = new SubscriptionHistory();
        $subscriptionHistory1->setSubscriber($user1);
        $subscription = $this->getReference('subscription_2');
        $subscriptionHistory1->setSubscription($subscription);
        $subscriptionHistory1->setStartDateAt(new \DateTime('2021-01-01'));
        $subscriptionHistory1->setEndDateAt(new \DateTime('2023-01-01'));
        $manager->persist($subscriptionHistory1);

        $subscriptionHistory2 = new SubscriptionHistory();
        $subscriptionHistory2->setSubscriber($user2);
        $subscription = $this->getReference('subscription_0');
        $subscriptionHistory2->setSubscription($subscription);
        $subscriptionHistory2->setStartDateAt(new \DateTime('2021-01-01'));
        $subscriptionHistory2->setEndDateAt(new \DateTime('2021-07-01'));
        $manager->persist($subscriptionHistory2);

        $subscriptionHistory3 = new SubscriptionHistory();
        $subscriptionHistory3->setSubscriber($user3);
        $subscription = $this->getReference('subscription_1');
        $subscriptionHistory3->setSubscription($subscription);
        $subscriptionHistory3->setStartDateAt(new \DateTime('2021-01-01'));
        $subscriptionHistory3->setEndDateAt(new \DateTime('2022-01-01'));
        $manager->persist($subscriptionHistory3);

        $playlist1 = new Playlist();
        $playlist1->setName('My favorite movies');
        $playlist1->setUserPlaylist($user1);
        $playlist1->setCreatedDateAt(new \DateTime('2021-01-01'));
        $playlist1->setUpdateDateAt(new \DateTime('2021-01-01'));
        $manager->persist($playlist1);

        $playlist2 = new Playlist();
        $playlist2->setName('My action series');
        $playlist2->setUserPlaylist($user2);
        $playlist2->setCreatedDateAt(new \DateTime('2021-01-01'));
        $playlist2->setUpdateDateAt(new \DateTime('2021-01-01'));
        $manager->persist($playlist2);

        $playlist3 = new Playlist();
        $playlist3->setName('My fantasy movies');
        $playlist3->setUserPlaylist($user3);
        $playlist3->setCreatedDateAt(new \DateTime('2021-01-01'));
        $playlist3->setUpdateDateAt(new \DateTime('2021-01-01'));
        $manager->persist($playlist3);

        $playlist4 = new Playlist();
        $playlist4->setName('My drama series');
        $playlist4->setUserPlaylist($user1);
        $playlist4->setCreatedDateAt(new \DateTime('2021-01-01'));
        $playlist4->setUpdateDateAt(new \DateTime('2021-01-01'));
        $manager->persist($playlist4);

        $playlisteSubscription1 = new PlaylistSubscription();
        $playlisteSubscription1->setUserPlaylistSubscription($user1);
        $playlisteSubscription1->setPlaylist($playlist1);
        $playlisteSubscription1->setSubscribedDateAt(new \DateTimeImmutable('2021-01-01'));
        $manager->persist($playlisteSubscription1);

        $playlisteSubscription2 = new PlaylistSubscription();
        $playlisteSubscription2->setUserPlaylistSubscription($user2);
        $playlisteSubscription2->setPlaylist($playlist2);
        $playlisteSubscription2->setSubscribedDateAt(new \DateTimeImmutable('2021-01-01'));
        $manager->persist($playlisteSubscription2);

        $playlisteSubscription3 = new PlaylistSubscription();
        $playlisteSubscription3->setUserPlaylistSubscription($user3);
        $playlisteSubscription3->setPlaylist($playlist3);
        $playlisteSubscription3->setSubscribedDateAt(new \DateTimeImmutable('2021-01-01'));
        $manager->persist($playlisteSubscription3);

        $playlisteSubscription4 = new PlaylistSubscription();
        $playlisteSubscription4->setUserPlaylistSubscription($user1);
        $playlisteSubscription4->setPlaylist($playlist4);
        $playlisteSubscription4->setSubscribedDateAt(new \DateTimeImmutable('2021-01-01'));
        $manager->persist($playlisteSubscription4);

        $playlisteMedia1 = new PlaylistMedia();
        $playlisteMedia1->setPlaylist($playlist1);
        $playlisteMedia1->setMedia($film1);
        $playlisteMedia1->setAddedDateAt(new \DateTimeImmutable('2021-01-01'));
        $manager->persist($playlisteMedia1);

        $playlisteMedia2 = new PlaylistMedia();
        $playlisteMedia2->setPlaylist($playlist2);
        $playlisteMedia2->setMedia($serie1);
        $playlisteMedia2->setAddedDateAt(new \DateTimeImmutable('2021-01-01'));
        $manager->persist($playlisteMedia2);

        $playlisteMedia3 = new PlaylistMedia();
        $playlisteMedia3->setPlaylist($playlist3);
        $playlisteMedia3->setMedia($film2);
        $playlisteMedia3->setAddedDateAt(new \DateTimeImmutable('2021-01-01'));
        $manager->persist($playlisteMedia3);

        $comment1 = new Comment();
        $comment1->setUserComment($user1);
        $comment1->setMedia($film1);
        $comment1->setContent('The Godfather is a great movie');
        $comment1->setStatusEnum(CommentStatusEnum::PUBLISHED);
        $manager->persist($comment1);

        $comment2 = new Comment();
        $comment2->setUserComment($user2);
        $comment2->setMedia($serie1);
        $comment2->setContent('Breaking Bad is a great series');
        $comment2->setStatusEnum(CommentStatusEnum::PUBLISHED);
        $manager->persist($comment2);

        $comment3 = new Comment();
        $comment3->setUserComment($user3);
        $comment3->setMedia($film2);
        $comment3->setContent('The Shawshank Redemption is a great movie');
        $comment3->setStatusEnum(CommentStatusEnum::PENDING);
        $manager->persist($comment3);

        $comment4 = new Comment();
        $comment4->setUserComment($user1);
        $comment4->setMedia($serie2);
        $comment4->setContent('Game of Thrones is a great series');
        $comment4->setStatusEnum(CommentStatusEnum::REJECTED);
        $manager->persist($comment4);

        $comment5 = new Comment();
        $comment5->setUserComment($user2);
        $comment5->setMedia($film1);
        $comment5->setParentComment($comment1);
        $comment5->setContent('I agree with you');
        $comment5->setStatusEnum(CommentStatusEnum::PUBLISHED);
        $manager->persist($comment5);

        $comment6 = new Comment();
        $comment6->setUserComment($user3);
        $comment6->setMedia($film1);
        $comment6->setParentComment($comment5);
        $comment6->setContent('I agree you agree with him');
        $comment6->setStatusEnum(CommentStatusEnum::PUBLISHED);
        $manager->persist($comment6);

        $watchHistory1 = new WatchHistory();
        $watchHistory1->setUserWatchHistory($user1);
        $watchHistory1->setMedia($film1);
        $watchHistory1->setLastWatchedDateAt(new \DateTime('2021-01-01'));
        $watchHistory1->setNumberOfViews(1);
        $manager->persist($watchHistory1);

        $watchHistory2 = new WatchHistory();
        $watchHistory2->setUserWatchHistory($user2);
        $watchHistory2->setMedia($serie1);
        $watchHistory2->setLastWatchedDateAt(new \DateTime('2021-12-01'));
        $watchHistory2->setNumberOfViews(2);
        $manager->persist($watchHistory2);

        $watchHistory3 = new WatchHistory();
        $watchHistory3->setUserWatchHistory($user3);
        $watchHistory3->setMedia($film2);
        $watchHistory3->setLastWatchedDateAt(new \DateTime('2021-06-21'));
        $watchHistory3->setNumberOfViews(2);
        $manager->persist($watchHistory3);

        $watchHistory4 = new WatchHistory();
        $watchHistory4->setUserWatchHistory($user1);
        $watchHistory4->setMedia($serie2);
        $watchHistory4->setLastWatchedDateAt(new \DateTime('2021-03-01'));
        $watchHistory4->setNumberOfViews(1);
        $manager->persist($watchHistory4);

        $manager->flush();
    }
}
