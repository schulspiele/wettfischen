# Wettfischen

## Database information
### Room-Status
Statuscode | Meaning
---|---
0 | Server error
1 | Room is currently running
2 | Room is displaying the results of the game (players failed OR teacher ended the game)
3 | Room has ended and is ready to be deleted
5 | Room is displaying the results of the last round
7 | Room is waiting for the next round to be started
9 | Room is open for people to join

## Libraries used
Task | Source | License | Version
---|---|---|---
Generating QR-Codes | gh@davidshimjs/qrcodejs | MIT | 12.03.2013 
jquery | jquery.com | MIT | 3.3.1