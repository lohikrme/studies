# TEE PELI TÄHÄN

# RAINING COINS AND GHOSTS - GAME
# Kolikoista saa pisteitä. Peli päättyy jos osuu kummitukseen.

#----------------------------------------------------------------
# hae kirjastot
import pygame
import random
import math

# luo funktio joka arpoo 40% tod näk
def fourty_percents():
    if random.randint(1, 10) <= 4:
        return True
    return False

# alusta kuvaruutu ja peli
pygame.init()
screen_leveys = 640
screen_korkeus = 480
screen = pygame.display.set_mode((screen_leveys, screen_korkeus))
running = True
kello = pygame.time.Clock()
pygame.display.set_caption("RAINING COINS AND GHOSTS - GAME")
points = 0
bold_font = pygame.font.SysFont("Arial", 26, bold=True)
game_over = False
game_restarts = False

# luo "pelaa uudelleen"- painike
restart_button_color = (100,40,220)
restart_button_leveys = 200
restart_button_korkeus = 50
restart_button_x = screen_leveys / 2 - restart_button_leveys / 2
restart_button_y = screen_korkeus / 2 - 200

restart_text = bold_font.render("Pelaa uudelleen!", True, (0,0,0))
restart_text_leveys = restart_text.get_width()
restart_text_korkeus = restart_text.get_height()

# alusta kolikot listana ja lisää niille attribuutteja
kolikko = pygame.image.load("kolikko.png")
kolikko_nopeus_original = 3
kolikko_nopeus = kolikko_nopeus_original
kolikko_leveys = kolikko.get_width()
kolikko_korkeus = kolikko.get_height()
kolikko_distance = -200

def luo_kolikko(jarjestysluku):
    kolikko_attribuutit = {
    "x_sijainti": random.randint(0, screen_leveys - kolikko_leveys),
    "y_sijainti": jarjestysluku*kolikko_distance,
    "y_nopeus": kolikko_nopeus
    }
    return kolikko_attribuutit

kolikot = []

# luo 10 kolikkoa, aloita järjestysluvusta 1
for i in range(1, 21):
    kolikot.append(luo_kolikko(i))

# luo samalla periaatteella kuin kolikot luotiin kummituksia, ensin alustus kummituksen attribuuteille
kummitus = pygame.image.load("hirvio.png")
kummitus_korkeus = kummitus.get_height()
kummitus_leveys = kummitus.get_width()
kummitus_nopeus_original = 1
kummitus_nopeus = kummitus_nopeus_original
kummitus_distance_original = -250
kummitus_distance = kummitus_distance_original
kummitus_amplitudi_original = 0.5
kummitus_amplitudi = kummitus_amplitudi_original
kummitus_taajuus_original = 0.002
kummitus_taajuus = kummitus_taajuus_original

# sitten lista johon kummitukset talletetaan
kummitukset = []

# luo metodi jolla luodaan uusia kummituksia
# opposite direction kääntää amplituden suunnan oikealta vasemmalle päin
def luo_kummitus(jarjestysluku):
    nopeasti_liikkuva = fourty_percents()
    laajasti_liikkuva = fourty_percents()
    opposite_direction = fourty_percents()
    
    kummitus_attribuutit = {
        "x_sijainti": random.randint(150, screen_leveys - kummitus_leveys - 150) if laajasti_liikkuva else random.randint(40, screen_leveys - kummitus_leveys - 40),
        "y_sijainti": jarjestysluku*kummitus_distance,
        "y_nopeus": kummitus_nopeus + random.randint(1,3) if nopeasti_liikkuva else kummitus_nopeus,
        "item_amplitudi": (kummitus_amplitudi + random.randint(6,9) if laajasti_liikkuva else kummitus_amplitudi + random.randint(0,2)) * (-1) if opposite_direction else kummitus_amplitudi + random.randint(6,9) if laajasti_liikkuva else kummitus_amplitudi + random.randint(0,2),
        "item_taajuus": kummitus_taajuus + random.uniform(0.001, 0.003) if laajasti_liikkuva else kummitus_taajuus + random.uniform(0.0025, 0.005)
    }
    return kummitus_attribuutit

# generoi 20 kummitusta alkaen järjestysluvusta 1
for i in range(1, 21):
    kummitukset.append(luo_kummitus(i))

# alusta robotti 
robo = pygame.image.load("robo.png")
robo_nopeus_original = 7
robo_nopeus = robo_nopeus_original
robo_leveys = robo.get_width()
robo_korkeus = robo.get_height()
robo_x = 200
robo_y = screen_korkeus - robo_korkeus - 2
robo_liikkuu_vasemmalle = False
robo_liikkuu_oikealle = False

# luo metodit joilla nopeasti saada tiedot kolikkon jokaisesta kulmasta:
def left_up_corner(sanakirja: dict):
    return [sanakirja["x_sijainti"], sanakirja["y_sijainti"]]

def right_up_corner(sanakirja: dict):
    return [sanakirja["x_sijainti"] + kolikko_leveys, sanakirja["y_sijainti"]]

def right_down_corner(sanakirja: dict):
    return [sanakirja["x_sijainti"] + kolikko_leveys, sanakirja["y_sijainti"] + kolikko_korkeus]

def left_down_corner(sanakirja: dict):
    return [sanakirja["x_sijainti"], sanakirja["y_sijainti"] + kolikko_korkeus]

# lisäksi metodi, joilla saadaan nopeasti tieto robotin sijainneista:
def robot_coordinates():
    left_up = {"x": robo_x, "y": robo_y}
    right_down = {"x": robo_x + robo_leveys, "y": robo_y + robo_korkeus}
    allowed_x_coordinates = left_up["x"], right_down["x"]
    allowed_y_coordinates = left_up["y"], right_down["y"]
    return (allowed_x_coordinates, allowed_y_coordinates)

# ------------------------------------------------------------------
# käynnistä peli 60fps nopeudella
while running:
    for event in pygame.event.get():

        # tarkista halutaanko peli sulkea
        if event.type == pygame.QUIT:
            running = False
        
        # tarkista halutaanko robottia liikuttaa
        if event.type == pygame.KEYDOWN:
            if event.key == pygame.K_a or event.key == pygame.K_LEFT:
                robo_liikkuu_vasemmalle = True
            elif event.key == pygame.K_d or event.key == pygame.K_RIGHT:
                robo_liikkuu_oikealle = True

        if event.type == pygame.KEYUP:
            if event.key == pygame.K_a or event.key == pygame.K_LEFT:
                robo_liikkuu_vasemmalle = False
            elif event.key == pygame.K_d or event.key == pygame.K_RIGHT:
                robo_liikkuu_oikealle = False

        # tarkista painetaanko pelaa uudelleen painiketta
        if event.type == pygame.MOUSEBUTTONUP:
            mouse_x, mouse_y = pygame.mouse.get_pos()
            if mouse_x >= restart_button_x and mouse_x <= restart_button_x + restart_button_leveys:
                if mouse_y >= restart_button_y and mouse_y <= restart_button_y + restart_button_korkeus:
                    game_restarts = True

    # piirrä näytön väri
    screen.fill((30,30,30))

    # piirrä pelaajan pistemäärä
    teksti = bold_font.render(f"Pisteet: {points}", True, (255,0,0))
    teksti_leveys = teksti.get_width()
    screen.blit(teksti, (screen_leveys-teksti_leveys-25, 10))
    
    # lisää kummitusten määrää kun pisteet kasvavat
    if points >= 50 and points < 100:
        kummitus_distance = -180
    elif points >= 100:
        kummitus_distance = -100

    # piirrä ja liikuta kolikkoja
    for item in kolikot:
        screen.blit(kolikko, (item["x_sijainti"], item["y_sijainti"]))

    for item in kolikot:
        item["y_sijainti"] += item["y_nopeus"]

    # piirrä ja liikuta kummituksia
    for item in kummitukset:
        screen.blit(kummitus, (item["x_sijainti"], item["y_sijainti"]))

    for item in kummitukset:    
        item["x_sijainti"] += item["item_amplitudi"] * math.sin(item["item_taajuus"] * item["y_sijainti"])
        item["y_sijainti"] += item["y_nopeus"]

    # piirrä ja liikuta robotti
    screen.blit(robo, (robo_x, robo_y))
    if robo_liikkuu_oikealle == True:
        if robo_x <= screen_leveys - robo_leveys:
            robo_x += robo_nopeus
        else:
            robo_x = screen_leveys - robo_leveys
    elif robo_liikkuu_vasemmalle == True:
        if robo_x >= 0:
            robo_x -= robo_nopeus
        else:
            robo_x = 0

    # jos kolikko osuu robottiin, kolikko palautetaan listalle ja pisteet kasvaa
    # osuma tarkistetaan testaamalla jokainen kolikkon 4 eri kulmasta, onko jokin niistä robotin koordinaattien sisällä
    # jos on, silloin pelaajalle annetaan yksi piste ja robotille arvotaan uusi sijainti negatiivisella y-arvolla
    allowed_x, allowed_y = robot_coordinates()

    for item in kolikot:
        osuma = False
        left_up = left_up_corner(item)
        right_up = right_up_corner(item)
        right_down = right_down_corner(item)
        left_down = left_down_corner(item)
        if left_up[0] >= allowed_x[0] and left_up[0] <= allowed_x[1] and left_up[1] >= allowed_y[0] and left_up[1] <= allowed_y[1]:
            osuma = True
        if right_up[0] >= allowed_x[0] and right_up[0] <= allowed_x[1] and right_up[1] >= allowed_y[0] and right_up[1] <= allowed_y[1]:
            osuma = True
        if right_down[0] >= allowed_x[0] and right_down[0] <= allowed_x[1] and right_down[1] >= allowed_y[0] and right_down[1] <= allowed_y[1]:
            osuma = True
        if left_down[0] >= allowed_x[0] and left_down[0] <= allowed_x[1] and left_down[1] >= allowed_y[0] and left_down[1] <= allowed_y[1]:
            osuma = True
        if osuma:
            kolikot.pop(0)
            kolikot.append(luo_kolikko(len(kolikot)))
            points += 1
        # jos kolikko osuu maahan, peli jatkuu mutta uusi kolikko luodaan tilalle
        if left_down[1] > screen_korkeus:
            kolikot.pop(0)
            kolikot.append(luo_kolikko(len(kolikot)))

    # jos kummitus osuu pelaajaan, peli päättyy:
    allowed_x, allowed_y = robot_coordinates()
    for item in kummitukset:
        osuma = False
        left_up = left_up_corner(item)
        right_up = right_up_corner(item)
        right_down = right_down_corner(item)
        left_down = left_down_corner(item)
        if left_up[0] >= allowed_x[0] and left_up[0] <= allowed_x[1] and left_up[1] >= allowed_y[0] and left_up[1] <= allowed_y[1]:
            osuma = True
        if right_up[0] >= allowed_x[0] and right_up[0] <= allowed_x[1] and right_up[1] >= allowed_y[0] and right_up[1] <= allowed_y[1]:
            osuma = True
        if right_down[0] >= allowed_x[0] and right_down[0] <= allowed_x[1] and right_down[1] >= allowed_y[0] and right_down[1] <= allowed_y[1]:
            osuma = True
        if left_down[0] >= allowed_x[0] and left_down[0] <= allowed_x[1] and left_down[1] >= allowed_y[0] and left_down[1] <= allowed_y[1]:
            osuma = True
        if osuma:
            kummitukset.pop(0)
            kummitukset.append(luo_kummitus(len(kummitukset)))
            game_over = True
        # jos kummitus osuu maahan, peli jatkuu mutta uusi kummitus luodaan tilalle
        if left_down[1] > screen_korkeus:
            kummitukset.pop(0)
            kummitukset.append(luo_kummitus(len(kummitukset)))
    
    #--------------------------------------------------------------------------
    # tarkista onko peli päättynyt
    if game_over:

        # pysäytä kolikot ja robotti ja kummitukset:
        for item in kolikot:
            item["y_nopeus"] = 0

        for item in kummitukset:
            item["y_nopeus"] = 0
            item["item_amplitudi"] = 0
            item["item_taajuus"] = 0

        robo_nopeus = 0

        # kirjoita viesti peli päättyi
        end_message = bold_font.render(f"Peli päättyi!", True, (255,0,0))
        end_message_leveys = end_message.get_width()
        screen.blit(end_message, (screen_leveys/2 - end_message_leveys/2, screen_korkeus/2 - 100))

        # laita pelaa uudelleen painike näkyville
        pygame.draw.rect(screen, restart_button_color, (restart_button_x, restart_button_y, restart_button_leveys, restart_button_korkeus))
        screen.blit(restart_text, (screen_leveys/2 - restart_text_leveys/2, restart_button_y/2 + restart_text_korkeus))

    # kun peli käynnistetään uudelleen luodaan uudet kolikot ja kummitukset
    # sekä palautetaan kaikki attribuutit alkuperäisiksi (siksi originallit erikseen)
    if game_restarts:
        # poista ensin olemassaolevat kolikot, palauta kolikon nopeus alkuperäiseksi, ja luo uudet kolikot
        kolikot = []
        kolikko_nopeus = kolikko_nopeus_original
        for i in range(1, 21):
            kolikot.append(luo_kolikko(i))

        # palauta robotille nopeus takaisin
        robo_nopeus = robo_nopeus_original

        # poista olemassaolevat kummitukset, palauta nopeus ja taajuus ennanlleen ja luo uudet kummitukset
        kummitukset = []
        kummitus_nopeus = kummitus_nopeus_original
        kummitus_taajuus = kummitus_taajuus_original
        kummitus_amplitudi = kummitus_amplitudi_original
        for i in range(1, 21):
            kummitukset.append(luo_kummitus(i))

        # palauta pisteet takaisin nollaan
        points = 0
        
        # palauta booleanit takaisin Falseen
        game_over = False
        game_restarts = False
        thirty_points = False
        sixty_points = False
        hundred_points = False

    # jokaisen 1/60 sekunnin lopuksi päivitä näyttö ja siirry seuraavaan kellonlyömään
    pygame.display.flip()
    kello.tick(60)

# varmista pelin lopullinen sammuminen käyttämällä pygame.quit()
pygame.quit()