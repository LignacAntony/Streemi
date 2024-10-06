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

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $subscription1 = new Subscription();
        $subscription1->setName('Basic');
        $subscription1->setPrice(30);
        $subscription1->setDurationInMonth(6);
        $manager->persist($subscription1);

        $subscription2 = new Subscription();
        $subscription2->setName('Premium');
        $subscription2->setPrice(50);
        $subscription2->setDurationInMonth(12);
        $manager->persist($subscription2);

        $subscription3 = new Subscription();
        $subscription3->setName('VIP');
        $subscription3->setPrice(90);
        $subscription3->setDurationInMonth(24);
        $manager->persist($subscription3);

        $film1 = new Movie();
        $film1->setMediaType(MediaTypeEnum::MOVIE);
        $film1->setTitle('The Godfather');
        $film1->setShortDescription('The aging patriarch of an organized crime dynasty transfers control of his clandestine empire to his reluctant son.');
        $film1->setLongDescription('The Godfather "Don" Vito Corleone is the head of the Corleone mafia family in New York. He is at the event of his daughter\'s wedding. Michael, Vito\'s youngest son and a decorated WWII Marine is also present at the wedding. Michael seems to be uninterested in being a part of the family business. Vito is a powerful man, and is kind to all those who give him respect but is ruthless against those who do not. But when a powerful and treacherous rival wants to sell drugs and needs the Don\'s influence for the same, Vito refuses to do it. What follows is a clash between Vito\'s fading old values and the new ways which may cause Michael to do the thing he was most reluctant in doing and wage a mob war against all the other mafia families which could tear the Corleone family apart.');
        $film1->setReleasedDateAt(new \DateTime('1972-03-24'));
        $film1->setCoverImage('https://www.imdb.com/title/tt0068646/mediaviewer/rm10105600/');
        $film1->setStaff(['Director' => 'Francis Ford Coppola', 'Writer' => 'Mario Puzo', 'Producer' => 'Albert S. Ruddy']);
        $film1->setCasting(['Marlon Brando', 'Al Pacino', 'James Caan', 'Richard S. Castellano', 'Robert Duvall', 'Sterling Hayden', 'John Marley', 'Richard Conte', 'Al Lettieri', 'Diane Keaton']);
        $manager->persist($film1);

        $film2 = new Movie();
        $film2->setMediaType(MediaTypeEnum::MOVIE);
        $film2->setTitle('The Shawshank Redemption');
        $film2->setShortDescription('Two imprisoned');
        $film2->setLongDescription('A banker convicted of uxoricide forms a friendship over a quarter century with a hardened convict, while maintaining his innocence and trying to remain hopeful through simple compassion.');
        $film2->setReleasedDateAt(new \DateTime('1994-09-23'));
        $film2->setCoverImage('https://www.imdb.com/title/tt0111161/mediaviewer/rm10105600/');
        $film2->setStaff(['Director' => 'Frank Darabont', 'Writer' => 'Stephen King', 'Producer' => 'Niki Marvin']);
        $film2->setCasting(['Tim Robbins', 'Morgan Freeman', 'Bob Gunton', 'William Sadler', 'Clancy Brown', 'Gil Bellows', 'Mark Rolston', 'James Whitmore', 'Jeffrey DeMunn', 'Larry Brandenburg']);
        $manager->persist($film2);

        $serie1 = new Serie();
        $serie1->setMediaType(MediaTypeEnum::SERIE);
        $serie1->setTitle('Breaking Bad');
        $serie1->setShortDescription('A high school chemistry teacher turned meth maker.');
        $serie1->setLongDescription('Walter White, a high school chemistry teacher, turned meth maker, teams up with a former student, Jesse Pinkman, to create and sell blue meth.');
        $serie1->setReleasedDateAt(new \DateTime('2008-01-20'));
        $serie1->setCoverImage('https://www.imdb.com/title/tt0903747/mediaviewer/rm10105600/');
        $serie1->setStaff(['Creator' => 'Vince Gilligan', 'Writer' => 'Vince Gilligan', 'Producer' => 'Vince Gilligan']);
        $serie1->setCasting(['Bryan Cranston', 'Aaron Paul', 'Anna Gunn', 'Betsy Brandt', 'Dean Norris', 'RJ Mitte', 'Bob Odenkirk', 'Jonathan Banks', 'Giancarlo Esposito', 'Steven Michael Quezada']);
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
        $serie2->setCoverImage('https://www.imdb.com/title/tt0944947/mediaviewer/rm10105600/');
        $serie2->setStaff(['Creator' => 'David Benioff', 'Writer' => 'David Benioff', 'Producer' => 'David Benioff']);
        $serie2->setCasting(['Emilia Clarke', 'Peter Dinklage', 'Kit Harington', 'Lena Headey', 'Sophie Turner', 'Maisie Williams', 'Nikolaj Coster-Waldau', 'Iain Glen', 'Alfie Allen', 'John Bradley']);
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
        $user1->setPassword('password');
        $user1->setAccountStatusEnum(AccountStatusEnum::ACTIVE);
        $user1->setCurrentSubscribtion($subscription3);
        $manager->persist($user1);

        $user2 = new User();
        $user2->setUsername('John');
        $user2->setEmail('john@exmple.com');
        $user2->setPassword('password');
        $user2->setAccountStatusEnum(AccountStatusEnum::ACTIVE);
        $user2->setCurrentSubscribtion($subscription1);
        $manager->persist($user2);

        $user3 = new User();
        $user3->setUsername('Jane');
        $user3->setEmail('jane@exemple.com');
        $user3->setPassword('password');
        $user3->setAccountStatusEnum(AccountStatusEnum::ACTIVE);
        $user3->setCurrentSubscribtion($subscription2);
        $manager->persist($user3);

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

        $subscriptionHistory1 = new SubscriptionHistory();
        $subscriptionHistory1->setSubscriber($user1);
        $subscriptionHistory1->setSubscription($subscription3);
        $subscriptionHistory1->setStartDateAt(new \DateTime('2021-01-01'));
        $subscriptionHistory1->setEndDateAt(new \DateTime('2023-01-01'));
        $manager->persist($subscriptionHistory1);

        $subscriptionHistory2 = new SubscriptionHistory();
        $subscriptionHistory2->setSubscriber($user2);
        $subscriptionHistory2->setSubscription($subscription1);
        $subscriptionHistory2->setStartDateAt(new \DateTime('2021-01-01'));
        $subscriptionHistory2->setEndDateAt(new \DateTime('2021-07-01'));
        $manager->persist($subscriptionHistory2);

        $subscriptionHistory3 = new SubscriptionHistory();
        $subscriptionHistory3->setSubscriber($user3);
        $subscriptionHistory3->setSubscription($subscription2);
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
