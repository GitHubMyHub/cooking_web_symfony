<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\User;
use App\Entity\Food;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $user = new User();
        $user->setEmail('test@test.de');
        $user->setPassword($this->encoder->encodePassword($user, 'test'));
        $manager->persist($user);

        $manager->flush();

        $food = new Food();
        $food->setName("Rosmarin gebratene Kartoffeln");
        $food->setDescription("<ol>
            <li>Ofen auf 220 Grad erhitzen</li>
            <li>Schneide den unteren Teil jeder Kartoffel und über Kreuz in einem Intervall von 1/8-inch. Schneide die Kartoffel auf einem Esslöffel dadurch wird verhindert, dass die Kartoffel komplett durchtrennt wird.</li>
            <li>Die Kartoffeln in eine große Schüssel geben und mit Olivenöl, Salz und Pfeffer und ein Esslöffel Rosmarin, vermengen. Die Gewürzmischung in die Spalten einarbeiten. Die Kartoffeln nun in einer Pfanne mit den Spalten nach oben anordnen.</li>
            <li>30 Minuten die Kartoffeln backen bis sie durch und eine goldene und Kruste haben.</li>
            <li>Streue nun das überschüssige Rosmarin drüber. Fertig.</li>
        </ol>");
        $food->setDescription2("<ul>
            <li>1,5 kg</li>
            <li>1/3 Tasse Olivenöl</li>
            <li>4 Teelöfel Salz</li>
            <li>2 Teelöfel schwarzer Pfeffer</li>
            <li>2 Esslöffel frisch gehackter Rosmarin</li>
        </ul>");
        $food->setDuration("00:15:00");
        $food->setPictureName("1/rosmarin_gebratene_kartoffeln.jpg");
        $food->setCreationDate(new \DateTime());
        $food->setCategory(2);
        $food->setVisible(1);
        $manager->persist($food);

        $manager->flush();


        $food = new Food();
        $food->setName("Nigiri Sushi");
        $food->setDescription("<ol>
            <li>Für das Grundrezept von Nigiri Sushi müssen Sie zuerst den Reis kochen. Dazu muss er unbedingt ausgiebig unter fließend kaltem Wasser gewaschen werden, bis alle Stärke gelöst ist. Wenn das Wasser klar bleibt, ist der Reis fertig zur Weiterverarbeitung.</li>
            <li>Setzen Sie einen Topf mit 1 Liter gesalzenem Wasser auf, lassen Sie das Wasser aufkochen und geben Sie dann den Reis hinzu. Lassen Sie diesen für etwa eine Minute aufkochen, dann legen Sie den Deckel auf, schalten den Herd aus und lassen den Topf 20 Minuten auf der heißen Platte stehen. Danach sollte der Reis gar, aber noch bissfest sein und alles Wasser aufgesogen haben. Ein Tipp: Noch einfacher geht es natürlich mit einem Reiskocher, der garantiert immer ein perfektes Ergebnis liefert.</li>
            <li>Während der Reis kocht, stellen Sie die Würzsauce her. Erhitzen Sie 6 Esslöffel Reisessig mit 4 Teelöffeln Zucker und 1 ½ Teelöffeln Salz, sodass sich alle Zutaten auflösen. Lassen Sie die Mischung danach auf Zimmertemperatur abkühlen.</li>
            <li>Wenn der Reis fertig ist, schütten Sie ihn auf eine Platte und lassen Sie ihn etwas abkühlen, er sollte aber immer noch ziemlich warm sein. Gießen Sie die Würzsauce darüber und vermengen Sie alles zügig miteinander. Am besten geht es am geöffneten Fenster oder unter Zuhilfenahme eines Stücks dicken Kartons, mit dem Sie frische Luft auf den Reis fächeln. Danach formen Sie mit Ihren angefeuchteten Händen daraus mundgerechte Häppchen in Nockenform.</li>
            <li>Schneiden Sie das Lachsfilet in möglichst flache, etwa 2 x 5 cm große Stücke, diese sollten etwas größer als die Reisnocken sein, damit sie an den Ränder leicht überlappen. Legen Sie die Lachsstücke in die geöffnete linke Hand, streichen Sie ein wenig Wasabi darauf und drücken Sie mit der anderen Hand die Reisnocke auf den Fisch. Prssen Sie beides etwas zusammen, aber achten Sie dabei darauf, dass der Reis seine Form behält. Platzieren Sie die Nigiri Sushi dekorativ auf einer Platte, wer möchte, kann die Häppchen noch mit hauchfein geschnittenen Frühlingszwiebeln oder in Streifen geschnittenem Rettich dekorieren.</li>
        </ol>");
        $food->setDescription2("<ul>
            <li>500g Sushireis</li>
            <li>0.5 TL Salz</li>
            <li>6 EL Reisessig</li>
            <li>4 TL Zucker</li>
            <li>1 l Wasser</li>
            <li>500g Lachsfilet in Sushiqualität</li>
            <li>1 EL Wasabi </li>
        </ul>");
        $food->setDuration("00:15:00");
        $food->setPictureName("2/nigiri_sushi.jpg");
        $food->setCreationDate(new \DateTime());
        $food->setCategory(1);
        $food->setVisible(1);
        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName("Käse Pizza");
        $food->setDescription("<ol>
            <li>Für den Teig Mehl in eine Schüssel sieben und mit Hefe und Zucker mischen.
        Das Wasser, Salz und Öl zugeben und alles zu einem glatten Teig verkneten. An einem warmen Ort oder im warmen Wasserbad abgedeckt ca. 45 min gehen lassen.
        Anschließend auf leicht gefetteten Blech ausbreiten während der Zubereitung des Belages nochmals abgedeckt gehen lassen.</li>
        
            <li>Für die Sauce die Knoblauchzehen abziehen und fein hacken. Im heißen Öl kurz andünsten, das Tomatenmark kurz darin anschwitzen mit den Tomaten ablöschen.
        Die Sauce bei geringer Hitze etwa 8-10 min einköcheln lassen.</li>
            <li>Inzwischen die Paprikaschoten putzen und in Streifen schneiden.</li>
            <li>Das Öl erhitzen und die Paprikastreifen darin ca. 5 min andünsten. Mit Salz, Pfeffer, evtl. Cayennepfeffer und Chiliflocken abschmecken.</li>
            <li>Inzwischen den Ofen auf 250°C Umluft erhitzen.</li>
            <li>Nun die Sauce mit Salz, Pfeffer und Kräutern abschmecken und auf dem Pizzateig verteilen.</li>
            <li>Die angedünsteten Paprikastreifen darauf verteilen.</li>
            <li>Die Zwiebeln abziehen, halbieren und in Ringe schneiden, mit den Peperoni ebenfalls auf der Pizza verteilen.</li>
            <li>Die Salami evtl. etwas zerkleinern und darüber streuen.</li>
            <li>Den Mozzarella in Scheiben schneiden und darauf verteilen.</li>
            <li>Auf der 2.Schiene von unten etwa 15-20 min knusprig backen.</li>
            <li>Fertig</li>
        </ol>");
        $food->setDescription2("<ul>
            <li><strong>Teig</strong></li>
            <li>300g Mehl</li>
            <li>1 Pck. Hefe (Trockenhefe)</li>
            <li>1 TL Zucker</li>
            <li>150 ml Wasser, warm</li>
            <li>1 TL Salz</li>
            <li>1 EL Olivenöl</li>
        </ul>
        <ul>
            <li><strong>Sauce</strong></li>
            <li>2 Knoblauchzehe(n), nach Belieben mehr</li>
            <li>2 TL Olivenöl</li>
            <li>1 EL Tomatenmark</li>
            <li>1 Dose Tomate(n), in Stücken</li>
            <li>Salz und Pfeffer, Basilikum, Rosmarin, Thymian, Cayennepfeffer und Chiliflocken</li>
        </ul>
        <ul>
            <li><strong>Belag</strong></li>
            <li>3 Paprikaschote(n), je rot. grün UND gelb</li>
            <li>1 EL Öl</li>
            <li>Salz und Pfeffer</li>
            <li>6 Peperoni, eingelegte</li>
            <li>2 Zwiebel(n)</li>
            <li>100g Salami, italienische in feinen Scheiben</li>
            <li>250g Mozzarella</li>
        </ul>");
        $food->setDuration("00:15:00");
        $food->setPictureName("3/kaese_pizza.jpg");
        $food->setCreationDate(new \DateTime());
        $food->setCategory(1);
        $food->setVisible(1);
        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName("Eier Salat");
        $food->setDescription("<ol>
            <li>Paprika putzen, waschen, längs halbieren und entkernen. Paprikahälften mit der Hautseite nach oben auf ein Backblech legen. Unter dem vorgeheizten Backofengrill bei 250 Grad 6—8 Minuten grillen, bis die Haut schwarze Blasen wirft. Paprika in einem Gefrierbeutel 5 Minuten ausdämpfen lassen, häuten und in mundgerechte Stücke schneiden.
            <li>Eier in kochendem Wasser in 9—10 Minuten hart kochen, abschrecken und pellen.</li>
            <li>Reichlich Wasser mit 2 El Meersalz in einem großen Topf aufkochen. Dicke Bohnen aus den Schoten palen. Grüne Bohnen putzen und in sprudelnd kochendem Salzwasser 5 Minuten garen. Mit einer Schaumkelle herausnehmen, in einem Sieb abschrecken und gut abtropfen lassen. Dicke Bohnen 2 Minuten im selben kochenden Salzwasser kochen, in ein Sieb gießen, abschrecken und gut abtropfen lassen. Bohnenkerne aus den Häuten drücken und zu den grünen Bohnen geben.</li>
            <li>Schalotten und Knoblauch in feine Würfel schneiden. 1 El Olivenöl in einem kleinen Topf erhitzen. Schalotten und Knoblauch darin bei mittlerer Hitze glasig dünsten. Anschließend beiseitestellen und abkühlen lassen.</li>
            <li>Brot in ca. 2 cm große Würfel schneiden. 4 El Olivenöl in einer Pfanne erhitzen. Brotwürfel darin rundum goldbraun rösten.</li>
            <li>Tomaten waschen und halbieren. Basilikumblätter von den Stielen abzupfen und grob schneiden. Oliven und Kapern in einem Sieb abtropfen lassen.</li>
            <li>Für das Dressing Weißweinessig mit Salz und Pfeffer verrühren. Das restliche Olivenöl, Schalotten und Knoblauch unterrühren. Oliven und Kapern zugeben. Eier vierteln.</li>
            <li>Paprika, Bohnen, Brotwürfel, Tomaten und Basilikum behutsam mit dem Dressing mischen. Salat mit Salz und Pfeffer abschmecken, in einer Schüssel oder auf einer Platte anrichten, die Eierviertel darauf verteilen und sofort servieren.</li>
        </ol>");
        $food->setDescription2("<ul>
            <li>2 Paprikaschoten, rot</li>
            <li>4 Eier, Kl. M</li>
            <li>Meersalz</li>
            <li>1 kg dicke Bohnen</li>
            <li>300 g grüne Bohnen</li>
            <li>2 Schalotten</li>
            <li>2 Zehen Knoblauch</li>
            <li>10 El Olivenöl</li>
            <li>150 g Baguette</li>
            <li>400 g Kirschtomaten</li>
            <li>2 Stiele Basilikum</li>
            <li>100 g Oliven, schwarz</li>
            <li>3 Tl Kapern, klein</li>
            <li>3 El Weißweinessig</li>
            <li>Salz</li>
            <li>Pfeffer</li>
        </ul>");
        $food->setDuration("0:15:00");
        $food->setPictureName("4/eier_salat.jpg");
        $food->setCreationDate(new \DateTime());
        $food->setCategory(2);
        $food->setVisible(1);
        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName("Gurken Salat");
        $food->setDescription("<ol>
            <li>Die grünen Bohnen putzen und in schräge Stücke schneiden.</li>
            <li>Reichlich Salzwasser 8-10 Minuten kochen. Im Eiswasser abschrecken und in eine Schüssel geben.</li>
            <li>Die grüne Gurke schälen und raspeln. Die Bohnen mit der Gurke vermengen und mit den Gewürzen abschmecken.</li>
            <li>Das Bohnenkraut waschen, klein schneiden und dazu geben.</li>
            <li>Den Salat lässt man gut durchziehen und serviert ihn anschließend als Beilage zum Hauptgericht oder eigenständig als Salat.</li>
        </ol>");
        $food->setDescription2("<ul>
            <li>1 Salatgurke(n)</li>
            <li>500g Bohnen, grüne</li>
            <li>Zucker</li>
            <li>Salz und Pfeffer</li>
            <li>1 Bund Bohnenkraut</li>
            <li>Essig</li>
            <li>Öl</li>
        </ul>");
        $food->setDuration("00:15:00");
        $food->setPictureName("5/gurken_salat.jpg");
        $food->setCreationDate(new \DateTime());
        $food->setCategory(2);
        $food->setVisible(1);
        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName("Vollkornkuchen mit Kirschen und Kokos");
        $food->setDescription("Beispiel Beschreibung");
        $food->setDescription2("Beispiel Beschreibung");
        $food->setDuration("0:15:00");
        $food->setPictureName("6/vollkornkuchen_mit_kirschen_und_kokos.jpg");
        $food->setCreationDate(new \DateTime());
        $food->setCategory(3);
        $food->setVisible(1);
        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName("Kirschschwammkuchen");
        $food->setDescription("<ol>
            <li>Ofen auf 180 Grad Ober-/ Unterhitze vorheizen. Backform ( ca. 20 x 20 cm) mit Backpapier auslegen.</li>
            <li>Butter mit Puderzucker schaumig schlagen. Eier einzeln dazugeben und mit der Milch verrühren. Mehl, Backpulver, Salz und Zitronenabrieb in einer separaten Schüssel mischen und dann zum Teig geben. Rasch zu einem homogenen Teig verrühren.</li>
            <li>Den Teig in die Form füllen und glatt streichen. Mit den Kirschen belegen und etwa 30 Minuten im heißen Ofen goldbraun backen. Nach dem Backen auskühlen lassen und dann mit etwas Puderzucker bestäuben</li>
        </ol>");
        $food->setDescription2("<ul>
            <li>125 g weiche Butter</li>
            <li>125 g Puderzucker</li>
            <li>1 Prise Salz</li>
            <li>0.25 Bio-Zitrone (Schale)</li>
            <li>2 Eier</li>
            <li>200 g Mehl</li>
            <li>0.5 Päckchen Backpulver</li>
            <li>60 ml Milch</li>
            <li>350 g Kirschen aus dem Glas, abgetropft</li>
        </ul>");
        $food->setDuration("01:15:26");
        $food->setPictureName("7/kirschschwammkuchen.jpg");
        $food->setCreationDate(new \DateTime());
        $food->setCategory(3);
        $food->setVisible(1);
        $manager->persist($food);

        $manager->flush();

        $food = new Food();
        $food->setName("Karottenkuchen");
        $food->setDescription("<ol>
            <li>Ofen auf 180 Grad (Umluft 160 Grad) vorheizen. Springform (Ø 26cm) gut einfetten.</li>
            <li>Für den Teig Möhren schälen und fein reiben. Die fein geriebenen Möhren mit der geriebenen Orangenschale, Mehl, Mandeln und Backpulver mischen.</li>
            <li>Die Eier trennen, das Eiweiß steif schlagen und zur Seite stellen. Eigelb mit Zucker, Öl und Orangensaft verrühren. Die Möhren-Mehl Masse zur Eiermasse geben und kurz durchrühren. Eiweiß unter den Teig heben. Kuchen im vorgeheizten Ofen circa 50 Minuten backen. Den Kuchen vollständig auskühlen lassen.</li>
        </ol>
        ");
        $food->setDescription2("Für den Teig
        <ul>
            <li>400g Karotten</li>
            <li>1 Prise Salz</li>
            <li>1 TL Orangenschale</li>
            <li>200 g gemahlene Mandeln</li>
            <li>200 g Mehl</li>
            <li>2 TL Backpulver</li>
            <li>4 Eier</li>
            <li>250 g Zucker</li>
            <li>100 ml Sonnenblumenöl</li>
            <li>2 EL Orangensaft</li>
            <li>Butter</li>
        </ul>
        
        Für die Glasur & Deko
        <ul>
            <li>200 g Puderzucker</li>
            <li>3 EL Orangensaft</li>
            <li>1 Pck. Marzipanmöhre</li>
        </ul>");
        $food->setDuration("01:01:26");
        $food->setPictureName("8/karottenkuchen.jpg");
        $food->setCreationDate(new \DateTime());
        $food->setCategory(3);
        $food->setVisible(1);
        $manager->persist($food);

        $manager->flush();

        /* CATEGORY */

        $category = new Category();
        $category->setName("");
        $manager->persist($category);

        $manager->flush();

        $category = new Category();
        $category->setName("Vegan");
        $manager->persist($category);

        $manager->flush();

        $category = new Category();
        $category->setName("Bakery");
        $manager->persist($category);

        $manager->flush();

    }
}
