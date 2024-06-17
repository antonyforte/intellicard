<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GroqController extends Controller
{

    public function show(){
        return view('ia-card-creation');
    }


    public function getGroqChatCompletion(Request $request)
    {
            $user_input = $request->input('user-text');
            $api_key = config('services.groq.api_key');
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $api_key,
                'Content-Type' => 'application/json',
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => 'Create 5 Cards in Anki format based on this text: ' . $user_input . 'Format the response, to be in the format of this example: **Card 1**
                        Front: What is the Treaty of Eden?
                        Back: A non-aggression pact between Trinity and Gehenna.
                        
                        **Card 2**
                        Front: When was the last time Trinity signed a treaty?
                        Back: 170 years ago, during the New Council of Nicaea.
                        ...'
                    ]
                ],
                'model' => 'llama3-8b-8192'
            ]);

            if ($response->successful()) {
                $data = json_decode($response->body(), true); // Decode the JSON response into an associative array

                // Extract the "content" from the response
                if (isset($data['choices'][0]['message']['content'])) {
                    $content =  $data['choices'][0]['message']['content'];
                } else {
                    $content =  'Content not found in the response.';
                }
            } else {
                $content = 'Request failed with status: ' . $response->status();
            }
        return response()->json(['usertext' => $user_input, 'response' => $content]);
    }

    public function responseCompilation($var) {
        $text = $var;
        $fronts = [];
        $backs = [];
    
        // Split the text into individual cards
        $cards = explode("**Card ", $text);
    
        // Remove the first element since it's empty
        array_shift($cards);
    
        // Loop through each card
        foreach ($cards as $card) {
            // Extract front content
            if (preg_match('/Front: (.+?)(\n|$)/', $card, $frontMatch)) {
                $fronts[] = trim($frontMatch[1]);
            } else {
                $fronts[] = ''; // Or handle the missing front content appropriately
            }
    
            // Extract back content
            if (preg_match('/Back: (.+?)(\n|$)/', $card, $backMatch)) {
                $backs[] = trim($backMatch[1]);
            } else {
                $backs[] = ''; // Or handle the missing back content appropriately
            }
        }
        return ['fronts' => $fronts, 'backs' => $backs];
    }
    

    public function getUserInput(Request $request)
    {
        $user_text = $request->user_text;/*"Battle of Sekigahara, (October 21, 1600), in Japanese history, a major conflict fought in central Honshu between vassals of Toyotomi Hideyoshi at the end of the Sengoku (“Warring States”) period. Led by daimyō Ishida Mitsunari, Toyotomi loyalists based mostly in western Japan clashed with largely eastern daimyō fighting for Tokugawa Ieyasu. The loyalists sought to preserve the Toyotomi legacy and halt Ieyasu’s rise to power. Ieyasu’s victory on the field laid the groundwork for the Tokugawa shogunate, which presided over Japan until 1868.
        Background
        
        Late 16th-century Japan saw the end of the Ashikaga shogunate and the unification of the provinces, a process that began with Oda Nobunaga and was completed by Toyotomi Hideyoshi in 1590. Shortly before his death in September 1598, Hideyoshi appointed five tairō, or regents, to protect his young son Hideyori and to rule on his behalf until he came of age. These tairō were Uesugi Kagekatsu, Mōri Terumoto, Maeda Toshiie, Ukita Hideie, and Tokugawa Ieyasu. When Hideyoshi died, Ieyasu relocated to Fushimi Castle, Hideyoshi’s magnificent palace in Kyōto, and approved several political marriages to cement alliances between his clan and neighbouring ones. Both the other tairō and several daimyō were troubled by these moves, as they feared that Ieyasu sought to supplant the young Toyotomi heir. Among them was Ishida Mitsunari, who formed a coalition of daimyō to reassert the authority of the Toyotomi clan and even went so far as to order an assassination attempt on Ieyasu. When that failed, Ieyasu refrained from killing him, instead moving to Ōsaka Castle to become Hideyori’s physical protector and further extend his power. On August 22, 1600, Mitsunari and his coalition formally denounced Ieyasu for this action and other transgressions. Ieyasu responded with a declaration of war.
        D-Day. American soldiers fire rifles, throw grenades and wade ashore on Omaha Beach next to a German bunker during D Day landing. 1 of 5 Allied beachheads est. in Normandy, France. The Normandy Invasion of World War II launched June 6, 1944.
        Britannica Quiz
        A History of War
        
        Ieyasu and Mitsunari’s respective alliances fell along largely geographic lines: daimyō who sided with Ieyasu were primarily in the east, whereas Toyotomi loyalists were primarily in the west. One notable exception to this division was Uesugi Kagekatsu, who had plotted with Mitsunari that spring to time an attack on Ieyasu from Uesugi’s lands in the east so that the daimyō would be caught between two armies. Ieyasu had begun to march east from Ōsaka as planned, but he tasked two of his eastern allies with quelling Uesugi and moved slowly in order to watch the movements of the western army.
        
        By September, Ieyasu had reached the city of Ōyama with some 50,000 men, and the western army had claimed both Ōsaka and Fushimi Castle. Ieyasu sent 31,000 soldiers southwest down the Tōkaidō road to capture Gifu Castle. He then directed his son, Tokugawa Hidetada, to move northwest along the Nakasendō road with 36,000 men. Finally, Ieyasu himself set out from his base with 30,000 men, intending for the three groups to reconvene in Mino province.
        
        In October the western armies besieged a few eastern strongholds, but they were unable to progress past Gifu, which had fallen to the Tōkaidō army. On October 19 Ieyasu entered Gifu at the head of a partially combined eastern army; Hidetada had besieged Ueda Castle against Ieyasu’s orders, which prevented his force from connecting with the other two. Mitsunari was stationed a short distance away at Ōgaki Castle with his forces. Fearing a direct attack, some of Mitsunari’s men attempted to raid Ieyasu’s camp on October 20, but neither side inflicted much damage. That night, the main body of the western army withdrew from Ōgaki and took up advantageous positions at Sekigahara.
        Battle
        
        Sekigahara was a village located in a mountainous valley at the intersection of a few major roads. Ieyasu’s army of nearly 89,000 soldiers entered the valley from the Nakasendō in the east with Fukushima Masanori at the vanguard; Ii Naomasa commanded a key division of shock troops. Having arrived at Sekigahara first, the western army placed a significant portion of its forces west of the village under the command of Ukita Hidei in the center, with Shimazu Yoshihiro to the north and Ōtani Yoshitsugu to the south. Kobayakawa Hideaki and his soldiers were positioned on the slopes of Mount Matsuo just south of the Ōtani forces, while Mōri Hidemoto and his vassals waited with Chōsokabe Morichika on Mount Nangū southwest of Ieyasu’s rear guard. Together, they made up a force of just under 82,000 men. Mitsunari’s strategy was to have Ukita, Shimazu, and Ōtani soldiers hold Ieyasu’s army in the valley until he gave the signal for the Kobayakawa and Mōri clans to descend on that army from the mountains, effectively trapping Ieyasu and his men on all sides. What Mitsunari did not know, however, was that Hideaki had secretly communicated to Ieyasu that he would fight for the Tokugawa when the time came. Kikkawa Hiroie had also been in communication with eastern generals, having informed them that the Mōri clan would not move during the battle. Both daimyō had been slighted by Mitsunari and so resolved to defy his orders at Sekigahara.
        Get a Britannica Premium subscription and gain access to exclusive content.
        Subscribe Now
        
        On the morning of October 21, a thick fog blanketed the valley until 8:00 am, at which time Naomasa’s shock troops circumvented their own vanguard command and made contact with the Ukita forces. Masanori followed close behind to support Naomasa. Shortly thereafter Ieyasu moved his left flank forward to engage with the Ōtani soldiers and directed nearly 20,000 men from his right flank to directly assault Mitsunari’s position, which was behind a series of fortifications adjacent to the Shimazu clan. Mitsunari ordered Shimazu Yoshihiro to move his troops forward, but the daimyō insisted on moving when he felt it was appropriate and refused to budge. At around 10:00 am the Tokugawa rear guard attacked some of the western divisions stationed on Mount Nangū. The fighting was most intense at the center, where the western coalition began to drive Ieyasu’s army back.
        
        At 11:00 am Mitsunari lit the signal fire for Kobayakawa Hideaki to flank the eastern army. Hideaki did not advance, either for the west or for the east. His inaction concerned Ōtani Yoshitsugu, who rotated half of his men to face Hideaki in anticipation of betrayal. Ieyasu also saw that Hideaki had yet to move. To test his loyalty, the daimyō ordered some of his arquebusiers to fire on the Kobayakawa soldiers. Shortly after noon Hideaki responded by sending his force of 15,000 men down the mountainside and into the Ōtani lines, which were now hemmed in on two sides. Four additional western divisions defected and attacked the Ōtani forces from a third side. Recognizing that his position was untenable, Yoshitsugu asked one of his retainers to kill him.
        
        Kobayakawa troops thoroughly disposed of the remaining Ōtani forces and proceeded to smash into the Ukita flank, prompting Ukita Hidei himself to flee the battlefield. Meanwhile, Ii Naomasa had engaged Shimazu Yoshihiro in his stationary position. At 1:30 pm Yoshihiro and his men began to retreat, but not before a volley of arquebus fire struck Naomasa and forced him to stop pursuing them. Yoshihiro fell back behind Mount Nangū, passing the Chōsokabe rear guard as they fled and informing them that the battle was going poorly. As promised, Kikkawa Hiroie refused to move his divisions for the west, and the Mōri and Chōsokabe clans were forced to follow suit, preventing some 20,000 men from possibly turning the tide of the battle. Mitsunari realized the extent of his army’s defections and retreated north into the mountains. At 2:00 pm, after six hours of fighting, Tokugawa Ieyasu declared his army victorious.
        Aftermath
        
        The Battle of Sekigahara was the last major conflict between the western and eastern armies. With Mitsunari’s coalition shattered, Ieyasu was able to capture Sawayama and Ōsaka castles in a matter of days. Mitsunari was beheaded in Kyōto within a month. At the formal conclusion of the war, Ieyasu stripped profitable lands from those prominent daimyō who opposed him and redistributed them among his allies, among whom were Kobayakawa Hideaki and Kikkawa Hiroie. Ieyasu installed Toyotomi Hideyori at Ōsaka Castle so that the Toyotomi vassals of the defeated coalition would look more favorably upon Ieyasu’s bloody campaign. Finally, in 1603 Emperor Go-Yōzei elevated Ieyasu to shōgun, the first of a line of Tokugawa shōguns that kept the peace for over 260 years.
        Myles Hudson
        Konishi Yukinaga
        Table of Contents
        Introduction
        References & Edit History
        Quick Facts & Related Topics
        Related Questions
        
            What is the difference between Christianity and Roman Catholicism?
            Who founded Roman Catholicism?
            What are the Roman Catholic sacraments?
            Why is Roman Catholicism so prominent in Latin America?
        
        Read Next
        Marriage. A couple getting married during a church wedding ceremony. (religion, ceremony, bride, groom)
        The Seven Sacraments of the Roman Catholic church
        Candles Burning On Table In Church
        What Is the Most Widely Practiced Religion in the World?
        The three children, Jacinta, Francisco and Lucia, who saw the vision of Fatima in Portugal. Our lady of Fatima, saint, Christianity.
        Our Lady of Fátima
        Agnes with a lamb near her feet. St. Agnes (Saint Agnes) design drawing for stained glass window by J&R Lamb Studios, ink, mount size 10.5 x 14.5 in.
        Roman Catholic Saints
        Saint Francis Xavier baptizing the infidels by an unknown painter, 18th century; in the collection of the Museo Nacional de Arte, Mexico City, Mexico.
        How did St. Francis Xavier shape Catholicism?
        Discover
        Giorgione, Italian, 1477/1478-1510, The Adoration of the Shepherds, 1505/1510, oil on panel, overall: 90.8 x 110.5 cm (35 3/4 x 43 1/2 in.), Samuel H. Kress Collection, 1939.1.289, National Gallery of Art, Washington, D.C.
        8 Must-See Paintings at the National Gallery of Art in Washington, D.C.
        Aurochs. Bos primigenius. Skeleton. Extinct animal. Skeleton of an Aurochs, an extinct wild ox.
        6 Animals We Ate Into Extinction
        Shadow of a man holding large knife in his hand inside of some dark, spooky buiding
        7 of History's Most Notorious Serial Killers 
        Secret Service Agent Listens To Earpiece
        Secret Service Code Names of 11 U.S. Presidents
        Figure 13: A Maxim machine gun, belt-fed and water-cooled, operated by German infantrymen, World War I.
        7 Deadliest Weapons in History
        The field takes the turn one after the restart during the 103rd Indianapolis 500 at Indianapolis Motor Speedway on May 26, 2019 in Indianapolis, Indiana. (auto racing, Indy 500)
        Why Is the Indy 500 Held on Memorial Day Weekend?
        Ice Sledge Hockey, Hockey Canada Cup, USA (left) vs Canada, 2009. UBC Thunderbird Arena, Vancouver, BC, competition site for Olympic ice hockey and Paralympic ice sledge hockey. Vancouver 2010 Olympic and Paralympic Winter Games, Vancouver Olympics
        10 Best Hockey Players of All Time
        Home
        World History
        Military Leaders
        Konishi Yukinaga
        Japanese general
        Written and fact-checked by
        Article History
        
        Died:
            Nov. 6, 1600, Kyōto
        
        Role In:
            Battle of Sekigahara
        
        Konishi Yukinaga (died Nov. 6, 1600, Kyōto) was a Christian general who spearheaded the Japanese invasion of Korea in 1592.
        
        The son of a prosperous Sakai merchant, who was also an important official in the feudal administration of the noted warrior Toyotomi Hideyoshi, Konishi followed his father into Hideyoshi’s service; he became one of the most trusted generals in Hideyoshi’s successful attempt to unify Japan under central control.
        
        When in 1592 Hideyoshi decided to invade Korea, Konishi’s troops were the first to land on Korean soil. For his early victories, which included the conquest of most of southern Korea, he received much glory. His small Japanese force was soon overextended, however, and Konishi was forced to accept the offer of a truce from Korea’s Chinese allies.
        
        Negotiations dragged on inconclusively until 1597, when Hideyoshi launched a new invasion of Korea. Konishi’s troops again met with early success, but just as they began to encounter stiff Chinese resistance, Hideyoshi died, and Konishi went home to participate in the civil wars to determine his successor. In the great Battle of Sekigahara (1600), his attempt to prevent control of the country from going to Tokugawa Ieyasu resulted in failure.
        
        Both Konishi and his father were converts to Roman Catholicism and were frequently mentioned in Jesuit reports from Japan as two of the most prominent and zealous Japanese Christians. It was because of his religious beliefs that Konishi, in the humiliation of defeat, refused to take his own life as his peers would have expected; he was instead captured and executed."; */

        return $user_text;
    }
}