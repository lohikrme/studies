# TEE RATKAISUSI TÄHÄN:


#----------MATEMAATTISTA TAUSTAA----------#
# ympyrässä on 360 astetta, 
# eli yksi sekuntti on 360/60 = 6 astetta.
# yksi minuutti on 360/60 = 6 astetta
# ja yksi tunti on 360 / 12 = 30 astetta
# näitä tietoja hyödyntämällä voin luoda graafisen kellon

# hae kirjastot
import pygame
import math
import time

# alusta kuvaruutu, fontit, yms.
pygame.init()
screen_leveys = 640
screen_korkeus = 480
screen = pygame.display.set_mode((screen_leveys, screen_korkeus))
running = True
kello = pygame.time.Clock()
bold_font = pygame.font.SysFont("Arial", 36, bold=True)

# alusta kellotaulun punainen ympyrä
clock_center = (screen_leveys/2, screen_korkeus/2)
clock_radius = 150
clock_width = 10
clock_color = (255, 0, 0)

# alusta viisareiden pituudet ja paksuudet
tuntiviisari_pituus = 80
tuntiviisari_paksuus = 10
tuntiviisari_color = (0, 40, 180)
minuuttiviisari_pituus = 110
minuuttiviisari_paksuus = 7
minuuttiviisari_color = (0, 169, 245)
sekuntiviisari_pituus = 140
sekuntiviisari_paksuus = 5
sekuntiviisari_color = (0, 169, 204)

# alusta numerot, talleta numero numerona ja sen kulma radiaaneina
# hyödynnä trigonometriaa ja laske numeroiden sijainti ottaen huomioon se,
# että yksikköympyrässä cos laskee viereisen = x suuntaisen,
# ja sin laskee vastakkaisen = y suuntaisen sivun pituuden
# ja niitä pitkin mennään vähän kuin vektoreilla kohti kellataulun rajaa
numerot = []
for i in range(1, 13):
    numero = i
    numeron_kulma = math.radians(i*30-90)
    numeron_x = clock_center[0] + (clock_radius-15) * math.cos(numeron_kulma)
    numeron_y = clock_center[1] + (clock_radius-15) * math.sin(numeron_kulma)
    numerot.append({"numero": i, "kulma": numeron_kulma, "x": numeron_x, "y": numeron_y})

# käynnistä kello 2fps nopeudella
while running:
    for event in pygame.event.get():
        if event.type == pygame.QUIT:
            running = False

    # hae joka tick uusin kellonaika järjestelmästä
    current_time = time.localtime()
    tunnit = current_time.tm_hour
    minuutit = current_time.tm_min
    sekunnit = current_time.tm_sec
    pygame.display.set_caption(f"{tunnit:02d}:{minuutit:02d}:{sekunnit:02d}")

    # piirrä graafinen kello, ensin harmaa sisus, sitten punainen reunus
    pygame.draw.circle(screen, (186, 186, 186), clock_center, clock_radius-clock_width+2)
    pygame.draw.circle(screen, clock_color, clock_center, clock_radius, clock_width)

    # Laske viisarien kulmat (huomaa -90, koska oletuksena kulma alkaa oikealle päin)
    # huomaa myös tuntiviisarissa minuutit * 0.5 koska tuntiviisari lähestyy hitaasti minuuttien edetessä
    tuntiviisari_kulma = math.radians(tunnit * 30 + minuutit * 0.5 - 90)
    minuuttiviisari_kulma = math.radians(minuutit * 6 - 90)
    sekuntiviisari_kulma = math.radians(sekunnit * 6 - 90)

    # Laske viisarien päätepisteet
    tuntiviisari_x = clock_center[0] + tuntiviisari_pituus * math.cos(tuntiviisari_kulma)
    tuntiviisari_y = clock_center[1] + tuntiviisari_pituus * math.sin(tuntiviisari_kulma)
    minuuttiviisari_x = clock_center[0] + minuuttiviisari_pituus * math.cos(minuuttiviisari_kulma)
    minuuttiviisari_y = clock_center[1] + minuuttiviisari_pituus * math.sin(minuuttiviisari_kulma)
    sekuntiviisari_x = clock_center[0] + sekuntiviisari_pituus * math.cos(sekuntiviisari_kulma)
    sekuntiviisari_y = clock_center[1] + sekuntiviisari_pituus * math.sin(sekuntiviisari_kulma)

    # Piirrä viisarit näytölle (alkaa clock centeristä, päättyy tupleen jossa x ja y koordinaatti)
    # syntaksi draw.line on siis minne, väri, alku(tuple), loppu(tuple), paksuus
    pygame.draw.line(screen, tuntiviisari_color, clock_center, (tuntiviisari_x, tuntiviisari_y), tuntiviisari_paksuus)
    pygame.draw.line(screen, minuuttiviisari_color, clock_center, (minuuttiviisari_x, minuuttiviisari_y), minuuttiviisari_paksuus)
    pygame.draw.line(screen, sekuntiviisari_color, clock_center, (sekuntiviisari_x, sekuntiviisari_y), sekuntiviisari_paksuus)

    # piirrä numerot kellotauluun (numerot on jo luotu aiemmin, koska sijainti pysyvä)
    # tarvitsemme suorakulmion, ja siihen center argumentin, koska aiemmin luodut koordinaatit
    # ovat vain tekstin keskipiste, ei sen alkupiste
    for numero in numerot:
        text = bold_font.render(str(numero["numero"]), True, ("yellow"))
        text_rect = text.get_rect(center=(numero["x"], numero["y"]))
        screen.blit(text, text_rect)

    pygame.display.flip()
    kello.tick(2)


pygame.quit()