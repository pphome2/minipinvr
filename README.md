# Mini-pi-NVR

Raspberry Pi NVR app.

# NVR

Fejlesztő: [pphome2](https:/github.com/pphome2)

**Aktuális verzió: 2021.**

Raspberry Pi használata biztonsági kamera rögzítőnek. Ehhez a Linux alaprendzser
`motion` programját használjuk, ami rögzíti a mozgásokat. Ez a program web-es felületet
biztosítít a rögzített fájlok kezeléséhez.

A rögzítés ki- és bekapcsolásához, valamint az időzítésekhez egy időszakos ellenőrző 
script-et használhatunk, amit `cron`-ból futtatunk. A rögzített fájlok naponkénti 
tárolását egy `cron`-ból futtatott script végzi. A program három előző napot tárol.
