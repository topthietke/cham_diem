<?php
$questions = json_decode(base64_decode('W3siaWQiOiJQSFAtMDAxIiwicXVlc3Rpb24iOiJUcm9uZyBQSFAgOC4xLCB0w61uaCBuxINuZyBuw6BvIGdpw7pwIMSR4buLbmggbmdoxKlhIHThuq1wIGjhu6NwIGPDoWMgZ2nDoSB0cuG7iyBo4bqxbmcgc+G7kSBjw7Mga2nhu4N1IHLDtSByw6BuZz8iLCJjYXRlZ29yeSI6IlBIUCBDb3JlIiwiZGlmZmljdWx0eSI6Ik1pZGRsZSIsInR5cGUiOiJUcuG6r2MgbmdoaeG7h20iLCJ0YWdzIjpbIlBIUCA4LjEiLCJFbnVtIiwiVHlwZSBTeXN0ZW0iXSwib3B0aW9ucyI6W3sibGFiZWwiOiJBIiwidGV4dCI6IlJlYWRvbmx5IFByb3BlcnRpZXMifSx7ImxhYmVsIjoiQiIsInRleHQiOiJFbnVtcyAtIGJhY2tlZCAmIHB1cmUgZW51bXMifSx7ImxhYmVsIjoiQyIsInRleHQiOiJGaWJlcnMifSx7ImxhYmVsIjoiRCIsInRleHQiOiJJbnRlcnNlY3Rpb24gVHlwZXMifV0sImNvcnJlY3QiOiJCIiwiZXhwbGFuYXRpb24iOiJQSFAgOC4xIGdp4bubaSB0aGnhu4d1IEVudW1zIGNobyBwaMOpcCDEkeG7i25oIG5naMSpYSB04bqtcCBo4bujcCBjw6FjIGdpw6EgdHLhu4sgY+G7kSDEkeG7i25oIGPDsyB0eXBlLXNhZmUuIFbDrSBk4bulOiBlbnVtIFN0YXR1czogc3RyaW5nIHsgY2FzZSBQZW5kaW5nID0gXCJwZW5kaW5nXCI7IH0uIFJlYWRvbmx5IHByb3BlcnRpZXMgY8WpbmcgbMOgIDguMSBuaMawbmcga2jDtG5nIGxpw6puIHF1YW4gxJHhur9uIHThuq1wIGjhu6NwIGjhurFuZyBz4buRLiIsInNjZW5hcmlvIjoiS2hpIHjDonkgZOG7sW5nIGjhu4cgdGjhu5FuZyBxdeG6o24gbMO9IMSRxqFuIGjDoG5nLCB0aGF5IHbDrCBkw7luZyBo4bqxbmcgc3RyaW5nIHLhu51pIHLhuqFjLCBkw7luZyBFbnVtIMSR4buDIHRyw6FuaCBs4buXaSB0eXBvIHbDoCDEkcaw4bujYyBJREUgaOG7lyB0cuG7oyBhdXRvY29tcGxldGUuIn0seyJpZCI6IlBIUC0wMDIiLCJxdWVzdGlvbiI6IlPhu7Ega2jDoWMgYmnhu4d0IGNow61uaCBnaeG7r2EgbWF0Y2ggZXhwcmVzc2lvbiB2w6Agc3dpdGNoIHRyb25nIFBIUCA4PyIsImNhdGVnb3J5IjoiUEhQIENvcmUiLCJkaWZmaWN1bHR5IjoiSnVuaW9yIiwidHlwZSI6IlRy4bqvYyBuZ2hp4buHbSIsInRhZ3MiOlsiUEhQIDgiLCJNYXRjaCIsIkNvbnRyb2wgU3RydWN0dXJlIl0sIm9wdGlvbnMiOlt7ImxhYmVsIjoiQSIsInRleHQiOiJtYXRjaCBkw7luZyBsb29zZSBjb21wYXJpc29uICg9PSkifSx7ImxhYmVsIjoiQiIsInRleHQiOiJtYXRjaCB5w6p1IGPhuqd1IGJyZWFrLCBzd2l0Y2ggdGjDrCBraMO0bmcifSx7ImxhYmVsIjoiQyIsInRleHQiOiJtYXRjaCBkw7luZyBzdHJpY3QgY29tcGFyaXNvbiAoPT09KSB2w6AgcmV0dXJuIHZhbHVlIn0seyJsYWJlbCI6IkQiLCJ0ZXh0IjoiS2jDtG5nIGPDsyBraMOhYyBiaeG7h3QifV0sImNvcnJlY3QiOiJDIiwiZXhwbGFuYXRpb24iOiJtYXRjaCBsw6AgZXhwcmVzc2lvbiB0cuG6oyB24buBIGdpw6EgdHLhu4ssIHNvIHPDoW5oIHN0cmljdCAoPT09KSwga2jDtG5nIGPhuqduIGJyZWFrIHbDoCBz4bq9IHRocm93IFVuaGFuZGxlZE1hdGNoRXJyb3IgbuG6v3Uga2jDtG5nIG1hdGNoIGNhc2UgbsOgbyB2w6Aga2jDtG5nIGPDsyBkZWZhdWx0LiIsImNvZGVTbmlwcGV0IjoiJHN0YXR1cyA9IG1hdGNoKCRjb2RlKSB7XG4gIDIwMCwgMjAxID0+ICdzdWNjZXNzJyxcbiAgNDA0ID0+ICdub3QgZm91bmQnLFxuICBkZWZhdWx0ID0+ICdlcnJvcicsXG59OyJ9LHsiaWQiOiJMQVItMDAzIiwicXVlc3Rpb24iOiJUcm9uZyBMYXJhdmVsLCBsw6BtIHRo4bq/IG7DoG8gxJHhu4Mga2jhuq9jIHBo4bulYyBs4buXaSBOKzEgcXVlcnkga2hpIGxvYWQgZGFuaCBzw6FjaCAxMDAgcG9zdHMgY8O5bmcgYXV0aG9yPyIsImNhdGVnb3J5IjoiTGFyYXZlbCIsImRpZmZpY3VsdHkiOiJNaWRkbGUiLCJ0eXBlIjoiVMOsbmggaHXhu5FuZyIsInRhZ3MiOlsiRWxvcXVlbnQiLCJOKzEiLCJQZXJmb3JtYW5jZSJdLCJvcHRpb25zIjpbeyJsYWJlbCI6IkEiLCJ0ZXh0IjoiRMO5bmcgREI6OnJhdygpIHRoYXkgY2hvIEVsb3F1ZW50In0seyJsYWJlbCI6IkIiLCJ0ZXh0IjoiRMO5bmcgd2l0aChcImF1dGhvclwiKSAtIGVhZ2VyIGxvYWRpbmcifSx7ImxhYmVsIjoiQyIsInRleHQiOiJUxINuZyBteXNxbCBtYXhfY29ubmVjdGlvbnMifSx7ImxhYmVsIjoiRCIsInRleHQiOiJEw7luZyBjYWNoZSBjaG8gbeG7l2kgcXVlcnkifV0sImNvcnJlY3QiOiJCIiwiZXhwbGFuYXRpb24iOiJOKzEgeOG6o3kgcmEga2hpIDEgcXVlcnkgbOG6pXkgcG9zdHMgKyBOIHF1ZXJ5IGzhuqV5IGF1dGhvci4gd2l0aChcImF1dGhvclwiKSBz4bq9IGfhu5lwIHRow6BuaCAyIHF1ZXJpZXMuIE5nb8OgaSByYSBjw7MgdGjhu4MgZMO5bmcgbGF6eSBlYWdlciBsb2FkaW5nLCBob+G6t2Mgd2l0aENvdW50IG7hur91IGNo4buJIGPhuqduIMSR4bq/bS4iLCJzY2VuYXJpbyI6IlByb2R1Y3Rpb24gbG9nIGNobyB0aOG6pXkgMSByZXF1ZXN0IC9hcGkvcG9zdHMgdOG7kW4gMTAxIHF1ZXJpZXMgKDEgKyAxMDApLiBTYXUga2hpIHRow6ptIC0+d2l0aChcImF1dGhvclwiKSBnaeG6o20gY8OybiAyIHF1ZXJpZXMsIHJlc3BvbnNlIHRpbWUgdOG7qyAxLjJzIHh14buRbmcgMTIwbXMuIEPhuqduIGtp4buDbSB0cmEgYuG6sW5nIExhcmF2ZWwgRGVidWdiYXIgaG/hurdjIFRlbGVzY29wZS4iLCJjb2RlU25pcHBldCI6Ii8vIEJlZm9yZTogMTAxIHF1ZXJpZXNcbiRwb3N0cyA9IFBvc3Q6OmFsbCgpO1xuZm9yZWFjaCgkcG9zdHMgYXMgJHBvc3QpICRwb3N0LT5hdXRob3ItPm5hbWU7XG5cbi8vIEFmdGVyOiAyIHF1ZXJpZXNcbiRwb3N0cyA9IFBvc3Q6OndpdGgoJ2F1dGhvcicpLT5nZXQoKTsifSx7ImlkIjoiTEFSLTAwNCIsInF1ZXN0aW9uIjoiS2hpIExhcmF2ZWwgUXVldWUgam9iIGLhu4sgZmFpbGVkIGxpw6puIHThu6VjLCBjw6FjaCB44butIGzDvSDEkcO6bmcgbMOgIGfDrD8iLCJjYXRlZ29yeSI6IkxhcmF2ZWwiLCJkaWZmaWN1bHR5IjoiU2VuaW9yIiwidHlwZSI6IlTDrG5oIGh14buRbmciLCJ0YWdzIjpbIlF1ZXVlIiwiRmFpbGVkIEpvYnMiLCJIb3Jpem9uIl0sIm9wdGlvbnMiOlt7ImxhYmVsIjoiQSIsInRleHQiOiJYw7NhIGpvYiBraOG7j2kgZmFpbGVkX2pvYnMgdGFibGUgdsOgIGLhu48gcXVhIn0seyJsYWJlbCI6IkIiLCJ0ZXh0IjoiSW1wbGVtZW50IGZhaWxlZCgpIG1ldGhvZCwgbG9nIGNvbnRleHQsIGPhuqV1IGjDrG5oIHJldHJ5ICsgYmFja29mZiwgZMO5bmcgaG9yaXpvbiBzdXBlcnZpc2lvbiJ9LHsibGFiZWwiOiJDIiwidGV4dCI6IkNo4bqheSBxdWV1ZTp3b3JrIHbhu5tpIC0tdHJpZXM9OTk5In0seyJsYWJlbCI6IkQiLCJ0ZXh0IjoiQ2h1eeG7g24gc2FuZyBzeW5jIGRyaXZlciJ9XSwiY29ycmVjdCI6IkIiLCJleHBsYW5hdGlvbiI6IkJlc3QgcHJhY3RpY2U6IDEpIGZhaWxlZCgpIG1ldGhvZCDEkeG7gyBub3RpZnkgU2xhY2ssIDIpIGPhuqV1IGjDrG5oICR0cmllcywgJGJhY2tvZmYsICRtYXhFeGNlcHRpb25zLCAzKSBkw7luZyBIb3Jpem9uIMSR4buDIGdpw6FtIHPDoXQsIDQpIHF1ZXVlOnJldHJ5IGhv4bq3YyByZXRyeVVudGlsKCksIDUpIHBow6JuIHTDrWNoIG5ndXnDqm4gbmjDom4gcm9vdCBjYXVzZSB0csaw4bubYyBraGkgcmV0cnkuIiwic2NlbmFyaW8iOiJKb2IgZ+G7rWkgZW1haWwgaW52b2ljZSBmYWlsIGRvIFNNVFAgdGltZW91dC4gR2nhuqNpIHBow6FwOiBiYWNrb2ZmIDMwcywgNjBzLCAxMjBzLCBsb2cgcmVxdWVzdF9pZCwgYWxlcnQgdsOgbyBTbGFjayBjaGFubmVsICNvcHMgbuG6v3UgZmFpbCAzIGzhuqduIGxpw6puIHRp4bq/cC4ifSx7ImlkIjoiU1lTLTAwNSIsInF1ZXN0aW9uIjoiSGnhu4duIHTGsOG7o25nIENhY2hlIFN0YW1wZWRlIHRyb25nIFJlZGlzIGzDoCBnw6wgdsOgIGPDoWNoIHBow7JuZyB0csOhbmg/IiwiY2F0ZWdvcnkiOiJTeXN0ZW0gQWRtaW4gJiBTZWN1cml0eSIsImRpZmZpY3VsdHkiOiJTZW5pb3IiLCJ0eXBlIjoiVMOsbmggaHXhu5FuZyIsInRhZ3MiOlsiUmVkaXMiLCJDYWNoZSIsIlN0YW1wZWRlIiwiTG9jayJdLCJvcHRpb25zIjpbeyJsYWJlbCI6IkEiLCJ0ZXh0IjoiQ2FjaGUgYuG7iyDEkeG6p3ksIGdp4bqjaSBwaMOhcCBsw6AgdMSDbmcgbWVtb3J5In0seyJsYWJlbCI6IkIiLCJ0ZXh0IjoiTmhp4buBdSByZXF1ZXN0IMSR4buTbmcgdGjhu51pIG1pc3MgY2FjaGUgdsOgIGPDuW5nIHF1ZXJ5IERCIC0gZMO5bmcgbXV0ZXggbG9jaywgZWFybHkgcmVjb21wdXRlLCBwcm9iYWJpbGlzdGljIGVhcmx5IGV4cGlyYXRpb24ifSx7ImxhYmVsIjoiQyIsInRleHQiOiJSZWRpcyBjcmFzaCwgZMO5bmcgcGVyc2lzdGVuY2UgQU9GIn0seyJsYWJlbCI6IkQiLCJ0ZXh0IjoiS2V5IGLhu4sgeMOzYSBuaOG6p20sIGLhuq10IGtleXNwYWNlIG5vdGlmaWNhdGlvbiJ9XSwiY29ycmVjdCI6IkIiLCJleHBsYW5hdGlvbiI6IlN0YW1wZWRlIHjhuqN5IHJhIGtoaSBrZXkgaOG6v3QgaOG6oW4sIGjDoG5nIG5naMOsbiByZXF1ZXN0IGPDuW5nIGzDumMgcXVlcnkgREIgZ8OieSBz4bqtcCBEQi4gR2nhuqNpIHBow6FwOiAxKSBMb2NrIChDYWNoZTo6bG9jayksIDIpIFJhbmRvbWl6ZSBUVEwsIDMpIFN0YWxlLXdoaWxlLXJldmFsaWRhdGUgcGF0dGVybiwgNCkgQmFja2dyb3VuZCByZWZyZXNoLiIsInNjZW5hcmlvIjoiRmxhc2ggc2FsZSAxMmggxJHDqm0sIGNhY2hlIHByb2R1Y3RfbGlzdCBo4bq/dCBo4bqhbiwgNTBrIHVzZXJzIEY1IMSR4buTbmcgdGjhu51pIC0+IERCIENQVSAxMDAlLiBGaXg6IENhY2hlOjpyZW1lbWJlciB24bubaSBsb2NrIDEwcywgY2jhu4kgMSByZXF1ZXN0IMSRxrDhu6NjIHBow6lwIHJlYnVpbGQgY2FjaGUuIiwiY29kZVNuaXBwZXQiOiJDYWNoZTo6bG9jaygncHJvZHVjdHM6bG9jaycsIDEwKS0+Z2V0KGZ1bmN0aW9uKCkge1xuICBDYWNoZTo6cHV0KCdwcm9kdWN0cycsIFByb2R1Y3Q6OmFsbCgpLCAzNjAwKTtcbn0pOyJ9LHsiaWQiOiJTRUMtMDA2IiwicXVlc3Rpb24iOiLEkG/huqFuIGNvZGUgbsOgbyBk4buFIGLhu4sgU1FMIEluamVjdGlvbj8iLCJjYXRlZ29yeSI6IlN5c3RlbSBBZG1pbiAmIFNlY3VyaXR5IiwiZGlmZmljdWx0eSI6Ikp1bmlvciIsInR5cGUiOiJDb2RlIiwidGFncyI6WyJTUUwgSW5qZWN0aW9uIiwiU2VjdXJpdHkiLCJQRE8iXSwib3B0aW9ucyI6W3sibGFiZWwiOiJBIiwidGV4dCI6IkRCOjp0YWJsZShcInVzZXJzXCIpLT53aGVyZShcImlkXCIsICRpZCktPmZpcnN0KCkifSx7ImxhYmVsIjoiQiIsInRleHQiOiIkcGRvLT5wcmVwYXJlKFwiU0VMRUNUICogRlJPTSB1c2VycyBXSEVSRSBpZCA9ID9cIiktPmV4ZWN1dGUoWyRpZF0pIn0seyJsYWJlbCI6IkMiLCJ0ZXh0IjoiXCJTRUxFQ1QgKiBGUk9NIHVzZXJzIFdIRVJFIG5hbWUgPSAnXCIgLiAkX0dFVFtcIm5hbWVcIl0gLiBcIidcIiJ9LHsibGFiZWwiOiJEIiwidGV4dCI6IlVzZXI6OndoZXJlSWQoJGlkKS0+Zmlyc3QoKSJ9XSwiY29ycmVjdCI6IkMiLCJleHBsYW5hdGlvbiI6Ik7hu5FpIGNodeG7l2kgdHLhu7FjIHRp4bq/cCB04burICRfR0VUIHbDoG8gcXVlcnkgbMOgIGzhu5cgaOG7lW5nIFNRTCBJbmplY3Rpb24gbmdoacOqbSB0cuG7jW5nLiBQaOG6o2kgZMO5bmcgcHJlcGFyZWQgc3RhdGVtZW50LCBFbG9xdWVudCBPUk0gaG/hurdjIFF1ZXJ5IEJ1aWxkZXIgduG7m2kgYmluZGluZy4iLCJzY2VuYXJpbyI6IkhhY2tlciBuaOG6rXAgbmFtZSA9ICcgT1IgMT0xIC0tICA9PiBs4buZIHRvw6BuIGLhu5kgdXNlcnMuIEF1ZGl0IHRvw6BuIGLhu5kgY29kZWJhc2UgdMOsbSByYXcgcXVlcnksIGLhuq10IEVsb3F1ZW50IHN0cmljdCBtb2RlLiJ9LHsiaWQiOiJTRUMtMDA3IiwicXVlc3Rpb24iOiJDw6FjaCBwaMOybmcgY2jhu5FuZyBYU1Mga2hpIHJlbmRlciBk4buvIGxp4buHdSB1c2VyIG5o4bqtcCB2w6BvIEJsYWRlPyIsImNhdGVnb3J5IjoiU3lzdGVtIEFkbWluICYgU2VjdXJpdHkiLCJkaWZmaWN1bHR5IjoiTWlkZGxlIiwidHlwZSI6IkNvZGUiLCJ0YWdzIjpbIlhTUyIsIkJsYWRlIiwiU2VjdXJpdHkiXSwib3B0aW9ucyI6W3sibGFiZWwiOiJBIiwidGV4dCI6IkTDuW5nIHshISAkdXNlcklucHV0ICEhfSBsdcO0biBsdcO0biJ9LHsibGFiZWwiOiJCIiwidGV4dCI6IkTDuW5nIHt7ICR1c2VySW5wdXQgfX0gLSBCbGFkZSB04buxIGVzY2FwZSwgY2jhu4kgZMO5bmcgeyEhICEhfSBraGkgxJHDoyBwdXJpZnkgSFRNTCJ9LHsibGFiZWwiOiJDIiwidGV4dCI6IkTDuW5nIHN0cmlwX3RhZ3MoKSB0cm9uZyBjb250cm9sbGVyIn0seyJsYWJlbCI6IkQiLCJ0ZXh0IjoiVOG6r3QgQ1NSRiBwcm90ZWN0aW9uIn1dLCJjb3JyZWN0IjoiQiIsImV4cGxhbmF0aW9uIjoie3sgfX0gZXNjYXBlIEhUTUwgZW50aXRpZXMgdOG7sSDEkeG7mW5nLiB7ISEgISF9IHJlbmRlciByYXcgSFRNTCAtIGNo4buJIGTDuW5nIGtoaSDEkcOjIHF1YSBIVE1MIFB1cmlmaWVyIGhv4bq3YyB0aW4gdMaw4bufbmcgbmd14buTbi4gS+G6v3QgaOG7o3AgduG7m2kgQ1NQIGhlYWRlciB2w6AgdmFsaWRhdGUgaW5wdXQuIn0seyJpZCI6IlNZUy0wMDgiLCJxdWVzdGlvbiI6IlByb2R1Y3Rpb24gZ+G6t3AgbOG7l2kgTmdpbnggNTAyIEJhZCBHYXRld2F5IHbhu5tpIFBIUC1GUE0sIHRo4bupIHThu7Ega2nhu4NtIHRyYT8iLCJjYXRlZ29yeSI6IlN5c3RlbSBBZG1pbiAmIFNlY3VyaXR5IiwiZGlmZmljdWx0eSI6Ik1pZGRsZSIsInR5cGUiOiJUw6xuaCBodeG7kW5nIiwidGFncyI6WyJOZ2lueCIsIlBIUC1GUE0iLCI1MDIiLCJPcHMiXSwib3B0aW9ucyI6W3sibGFiZWwiOiJBIiwidGV4dCI6IlJlc3RhcnQgc2VydmVyIG5nYXkgbOG6rXAgdOG7qWMifSx7ImxhYmVsIjoiQiIsInRleHQiOiJDaGVjayBwaHAtZnBtIHN0YXR1cywgc29ja2V0IHBlcm1pc3Npb24sIHBtLm1heF9jaGlsZHJlbiwgc2xvdyBsb2csIG5naW54IGVycm9yIGxvZyJ9LHsibGFiZWwiOiJDIiwidGV4dCI6IlTEg25nIG5naW54IHdvcmtlcl9jb25uZWN0aW9ucyJ9LHsibGFiZWwiOiJEIiwidGV4dCI6IljDs2EgY2FjaGUgb3BjYWNoZSJ9XSwiY29ycmVjdCI6IkIiLCJleHBsYW5hdGlvbiI6IlF1eSB0csOsbmg6IDEpIHN5c3RlbWN0bCBzdGF0dXMgcGhwOC4xLWZwbSwgMikgdGFpbCAtZiAvdmFyL2xvZy9waHAtZnBtL2Vycm9yLmxvZywgMykga2nhu4NtIHRyYSBzb2NrZXQgL3J1bi9waHAvcGhwLWZwbS5zb2NrIHF1eeG7gW4sIDQpIHBtLm1heF9jaGlsZHJlbiDEkeG6p3kgLT4gdMSDbmcgaG/hurdjIG9wdGltaXplLCA1KSBraeG7g20gdHJhIHNsb3cgbG9nIHTDrG0gcXVlcnkgY2jhuq1tLiIsInNjZW5hcmlvIjoiU8OhbmcgVDIgdHJhZmZpYyB0xINuZyDEkeG7mXQgYmnhur9uLCBwbS5tYXhfY2hpbGRyZW49MjAgxJHhuqd5IC0+IDUwMi4gVOG6oW0gdGjhu51pIHTEg25nIGzDqm4gNTAsIHNhdSDEkcOzIHBow6JuIHTDrWNoIHNsb3cgbG9nIHRo4bqleSAxIHF1ZXJ5IHRoaeG6v3UgaW5kZXguIn0seyJpZCI6IlNZUy0wMDkiLCJxdWVzdGlvbiI6IkRvY2tlciBjb250YWluZXIgTGFyYXZlbCBraMO0bmcga+G6v3QgbuG7kWkgxJHGsOG7o2MgTXlTUUwgY29udGFpbmVyLCBuZ3V5w6puIG5ow6JuIHBo4buVIGJp4bq/bj8iLCJjYXRlZ29yeSI6IlN5c3RlbSBBZG1pbiAmIFNlY3VyaXR5IiwiZGlmZmljdWx0eSI6Ik1pZGRsZSIsInR5cGUiOiJUw6xuaCBodeG7kW5nIiwidGFncyI6WyJEb2NrZXIiLCJOZXR3b3JraW5nIiwiQ29tcG9zZSJdLCJvcHRpb25zIjpbeyJsYWJlbCI6IkEiLCJ0ZXh0IjoiRMO5bmcgREJfSE9TVD0xMjcuMC4wLjEgdHJvbmcgTGFyYXZlbCBjb250YWluZXIifSx7ImxhYmVsIjoiQiIsInRleHQiOiJUaGnhur91IGV4dGVuc2lvbiBwZG9fbXlzcWwifSx7ImxhYmVsIjoiQyIsInRleHQiOiJD4bqjIEEgdsOgIEIsIG7Dqm4gZMO5bmcgc2VydmljZSBuYW1lIGzDoG0gaG9zdCJ9LHsibGFiZWwiOiJEIiwidGV4dCI6IkRvY2tlciBraMO0bmcgaOG7lyB0cuG7oyBNeVNRTCJ9XSwiY29ycmVjdCI6IkMiLCJleHBsYW5hdGlvbiI6IlRyb25nIERvY2tlciBuZXR3b3JrLCBt4buXaSBjb250YWluZXIgY8OzIElQIHJpw6puZy4gMTI3LjAuMC4xIHRyb25nIGFwcCBjb250YWluZXIgbMOgIGNow61uaCBuw7MsIGtow7RuZyBwaOG6o2kgbXlzcWwuIFBo4bqjaSBkw7luZyBEQl9IT1NUPW15c3FsIChzZXJ2aWNlIG5hbWUpIHbDoCDEkeG6o20gYuG6o28gY8O5bmcgbmV0d29yaywgd2FpdC1mb3ItaXQgc2NyaXB0LiIsImNvZGVTbmlwcGV0IjoiIyBkb2NrZXItY29tcG9zZS55bWxcbnNlcnZpY2VzOlxuICBhcHA6XG4gICAgZGVwZW5kc19vbjogW215c3FsXVxuICBteXNxbDpcbiAgICBpbWFnZTogbXlzcWw6OC4wIn0seyJpZCI6IlBIUC0wMTAiLCJxdWVzdGlvbiI6IkNvbXBvc2VyOiBz4buxIGtow6FjIGJp4buHdCBnaeG7r2EgY29tcG9zZXIgaW5zdGFsbCB2w6AgY29tcG9zZXIgdXBkYXRlPyIsImNhdGVnb3J5IjoiUEhQIENvcmUiLCJkaWZmaWN1bHR5IjoiSnVuaW9yIiwidHlwZSI6IlRy4bqvYyBuZ2hp4buHbSIsInRhZ3MiOlsiQ29tcG9zZXIiLCJEZXBlbmRlbmN5Il0sIm9wdGlvbnMiOlt7ImxhYmVsIjoiQSIsInRleHQiOiJHaeG7kW5nIG5oYXUgaG/DoG4gdG/DoG4ifSx7ImxhYmVsIjoiQiIsInRleHQiOiJpbnN0YWxsIMSR4buNYyBjb21wb3Nlci5sb2NrLCB1cGRhdGUgxJHhu41jIGNvbXBvc2VyLmpzb24gdsOgIGPhuq1wIG5o4bqtdCBsb2NrIGZpbGUifSx7ImxhYmVsIjoiQyIsInRleHQiOiJpbnN0YWxsIG5oYW5oIGjGoW4gdsOsIGtow7RuZyBj4bqnbiBpbnRlcm5ldCJ9LHsibGFiZWwiOiJEIiwidGV4dCI6InVwZGF0ZSBjaOG7iSBkw7luZyBjaG8gZGV2In1dLCJjb3JyZWN0IjoiQiIsImV4cGxhbmF0aW9uIjoiUHJvZHVjdGlvbiBsdcO0biBkw7luZyBjb21wb3NlciBpbnN0YWxsIC0tbm8tZGV2IMSR4buDIMSR4bqjbSBi4bqjbyB2ZXJzaW9uIGdp4buRbmcgaOG7h3QgbG9jayBmaWxlLiBjb21wb3NlciB1cGRhdGUgc+G6vSBuw6JuZyBj4bqlcCBwYWNrYWdlIHRoZW8gcsOgbmcgYnXhu5ljIHRyb25nIGNvbXBvc2VyLmpzb24gdsOgIGdoaSBs4bqhaSBsb2NrIGZpbGUgbeG7m2kuIn0seyJpZCI6Ik9PUC0wMTEiLCJxdWVzdGlvbiI6Ik5ndXnDqm4gdOG6r2MgRGVwZW5kZW5jeSBJbnZlcnNpb24gKERJUCkgdHJvbmcgU09MSUQgbsOzaSB24buBPyIsImNhdGVnb3J5IjoiT09QL1BlcmZvcm1hbmNlIiwiZGlmZmljdWx0eSI6Ik1pZGRsZSIsInR5cGUiOiJUcuG6r2MgbmdoaeG7h20iLCJ0YWdzIjpbIlNPTElEIiwiRElQIiwiT09QIl0sIm9wdGlvbnMiOlt7ImxhYmVsIjoiQSIsInRleHQiOiJDbGFzcyBjb24gcGjhuqNpIHRoYXkgdGjhur8gxJHGsOG7o2MgY2xhc3MgY2hhIn0seyJsYWJlbCI6IkIiLCJ0ZXh0IjoiSGlnaC1sZXZlbCBtb2R1bGUga2jDtG5nIHBo4bulIHRodeG7mWMgbG93LWxldmVsIG1vZHVsZSwgY+G6oyBoYWkgcGjhu6UgdGh14buZYyBhYnN0cmFjdGlvbiJ9LHsibGFiZWwiOiJDIiwidGV4dCI6Ik3hu5l0IGNsYXNzIGNo4buJIG7Dqm4gY8OzIG3hu5l0IGzDvSBkbyDEkeG7gyB0aGF5IMSR4buVaSJ9LHsibGFiZWwiOiJEIiwidGV4dCI6IsavdSB0acOqbiBjb21wb3NpdGlvbiBvdmVyIGluaGVyaXRhbmNlIn1dLCJjb3JyZWN0IjoiQiIsImV4cGxhbmF0aW9uIjoiRElQIGzDoCBu4buBbiB04bqjbmcgY+G7p2EgTGFyYXZlbCBTZXJ2aWNlIENvbnRhaW5lci4gVGhheSB2w6wgbmV3IE1haWxTZXJ2aWNlKCkgdHLhu7FjIHRp4bq/cCwgaW5qZWN0IHF1YSBpbnRlcmZhY2UgTWFpbGVySW50ZXJmYWNlLCBnacO6cCBk4buFIHRlc3QgdsOgIMSR4buVaSBpbXBsZW1lbnRhdGlvbi4iLCJjb2RlU25pcHBldCI6Ii8vIFThu5F0OiBwaOG7pSB0aHXhu5ljIGFic3RyYWN0aW9uXG5wdWJsaWMgZnVuY3Rpb24gX19jb25zdHJ1Y3QoTWFpbGVySW50ZXJmYWNlICRtYWlsZXIpIHt9XG4vLyBY4bqldTogcGjhu6UgdGh14buZYyBjb25jcmV0aW9uXG5wdWJsaWMgZnVuY3Rpb24gX19jb25zdHJ1Y3QoU210cE1haWxlciAkbWFpbGVyKSB7fSJ9LHsiaWQiOiJEQi0wMTIiLCJxdWVzdGlvbiI6Ik15U1FMIGRlYWRsb2NrIHjhuqN5IHJhIGtoaSBuw6BvIHbDoCBjw6FjaCB44butIGzDvSB0cm9uZyBMYXJhdmVsPyIsImNhdGVnb3J5IjoiTXlTUUwvRGF0YWJhc2UiLCJkaWZmaWN1bHR5IjoiU2VuaW9yIiwidHlwZSI6IlTDrG5oIGh14buRbmciLCJ0YWdzIjpbIk15U1FMIiwiRGVhZGxvY2siLCJUcmFuc2FjdGlvbiJdLCJvcHRpb25zIjpbeyJsYWJlbCI6IkEiLCJ0ZXh0IjoiS2hpIDIgdHJhbnNhY3Rpb24ga2jDs2EgY2jDqW8gbmhhdSAtIGTDuW5nIHJldHJ5LCBz4bqvcCB44bq/cCB0aOG7qSB04buxIGxvY2ssIGdp4bqjbSBpc29sYXRpb24gbGV2ZWwgbuG6v3UgY+G6p24ifSx7ImxhYmVsIjoiQiIsInRleHQiOiJLaGkgdGFibGUgcXXDoSBs4bubbiJ9LHsibGFiZWwiOiJDIiwidGV4dCI6IktoaSB0aGnhur91IGluZGV4In0seyJsYWJlbCI6IkQiLCJ0ZXh0IjoiS2jDtG5nIHRo4buDIHjhuqN5IHJhIHbhu5tpIElubm9EQiJ9XSwiY29ycmVjdCI6IkEiLCJleHBsYW5hdGlvbiI6IkRlYWRsb2NrOiBUMSBsb2NrIHJvdyBBIGNo4budIHJvdyBCLCBUMiBsb2NrIHJvdyBCIGNo4budIHJvdyBBLiBJbm5vREIgdOG7sSBkZXRlY3QgdsOgIHJvbGxiYWNrIDEgdHJhbnNhY3Rpb24uIFRyb25nIExhcmF2ZWw6IERCOjp0cmFuc2FjdGlvbiB24bubaSByZXRyeSAzIGzhuqduLCBob+G6t2MgxJHhuqNtIGLhuqNvIGxvY2sgdGhlbyBjw7luZyB0aOG7qSB04buxIGlkIEFTQy4iLCJzY2VuYXJpbyI6IkpvYiB44butIGzDvSBvcmRlciDEkeG7k25nIHRo4budaSB1cGRhdGUgc3RvY2s6IG9yZGVyIGlkIDEgdsOgIDIgY8O5bmcgY2jhuqF5LCBkZWFkbG9jay4gRml4OiBTRUxFQ1QgLi4uIEZPUiBVUERBVEUgT1JERVIgQlkgaWQgdsOgIHJldHJ5IGxvZ2ljLiJ9LHsiaWQiOiJEQi0wMTMiLCJxdWVzdGlvbiI6IsSQ4buDIHThu5FpIMawdSBxdWVyeSBTRUxFQ1QgKiBGUk9NIG9yZGVycyBXSEVSRSB1c2VyX2lkPTUgQU5EIHN0YXR1cz1cInBhaWRcIiBPUkRFUiBCWSBjcmVhdGVkX2F0IERFU0MsIGluZGV4IHThu5F0IG5o4bqldCBsw6A/IiwiY2F0ZWdvcnkiOiJNeVNRTC9EYXRhYmFzZSIsImRpZmZpY3VsdHkiOiJNaWRkbGUiLCJ0eXBlIjoiQ29kZSIsInRhZ3MiOlsiSW5kZXgiLCJNeVNRTCIsIlBlcmZvcm1hbmNlIl0sIm9wdGlvbnMiOlt7ImxhYmVsIjoiQSIsInRleHQiOiJJTkRFWCh1c2VyX2lkKSJ9LHsibGFiZWwiOiJCIiwidGV4dCI6IklOREVYKHN0YXR1cykifSx7ImxhYmVsIjoiQyIsInRleHQiOiJJTkRFWCh1c2VyX2lkLCBzdGF0dXMsIGNyZWF0ZWRfYXQgREVTQykgLSBjb21wb3NpdGUgaW5kZXggdGhlbyB0aOG7qSB04buxIGZpbHRlciArIHNvcnQifSx7ImxhYmVsIjoiRCIsInRleHQiOiJJTkRFWChjcmVhdGVkX2F0KSJ9XSwiY29ycmVjdCI6IkMiLCJleHBsYW5hdGlvbiI6IkNvbXBvc2l0ZSBpbmRleCB0dcOibiB0aOG7pyBsZWZ0bW9zdCBwcmVmaXg6IHVzZXJfaWQgKGVxdWFsaXR5KSwgc3RhdHVzIChlcXVhbGl0eSksIGNyZWF0ZWRfYXQgKHNvcnQpLiBEw7luZyBFWFBMQUlOIMSR4buDIHZlcmlmeSBFeHRyYSBraMO0bmcgY8OzIFVzaW5nIGZpbGVzb3J0LiIsImNvZGVTbmlwcGV0IjoiQUxURVIgVEFCTEUgb3JkZXJzIEFERCBJTkRFWCBpZHhfdXNlcl9zdGF0dXNfY3JlYXRlZCBcbih1c2VyX2lkLCBzdGF0dXMsIGNyZWF0ZWRfYXQgREVTQyk7In0seyJpZCI6IlBIUC0wMTQiLCJxdWVzdGlvbiI6IlBIUC1GUE0gcG0gPSBkeW5hbWljIHZzIG9uZGVtYW5kIHZzIHN0YXRpYywga2hpIG7DoG8gZMO5bmc/IiwiY2F0ZWdvcnkiOiJPT1AvUGVyZm9ybWFuY2UiLCJkaWZmaWN1bHR5IjoiU2VuaW9yIiwidHlwZSI6IlTDrG5oIGh14buRbmciLCJ0YWdzIjpbIlBIUC1GUE0iLCJQZXJmb3JtYW5jZSIsIlR1bmluZyJdLCJvcHRpb25zIjpbeyJsYWJlbCI6IkEiLCJ0ZXh0IjoiTHXDtG4gZMO5bmcgc3RhdGljIGNobyBt4buNaSBjYXNlIn0seyJsYWJlbCI6IkIiLCJ0ZXh0IjoiZHluYW1pYyBjaG8gdHJhZmZpYyBiaeG6v24gxJHhu5luZywgc3RhdGljIGNobyB0cmFmZmljIOG7lW4gxJHhu4tuaCBjYW8sIG9uZGVtYW5kIGNobyBsb3cgdHJhZmZpYy9kZXYgdGnhur90IGtp4buHbSBSQU0ifSx7ImxhYmVsIjoiQyIsInRleHQiOiJvbmRlbWFuZCBsw6AgbmhhbmggbmjhuqV0In0seyJsYWJlbCI6IkQiLCJ0ZXh0IjoiS2jDtG5nIHF1YW4gdHLhu41uZyJ9XSwiY29ycmVjdCI6IkIiLCJleHBsYW5hdGlvbiI6InN0YXRpYzogZ2nhu68gc+G6tW4gcG0ubWF4X2NoaWxkcmVuIHByb2Nlc3MgKHThu5F0IGNobyBoaWdoIHRyYWZmaWMsIGdp4bqjbSBvdmVyaGVhZCkuIGR5bmFtaWM6IGxpbmggaG/huqF0IG1pbi9tYXhfc3BhcmVfc2VydmVycy4gb25kZW1hbmQ6IHThuqFvIHByb2Nlc3Mga2hpIGPDsyByZXF1ZXN0LCB0aeG6v3Qga2nhu4dtIFJBTSBuaMawbmcgbGF0ZW5jeSBjYW8gaMahbi4ifSx7ImlkIjoiTEFSLTAxNSIsInF1ZXN0aW9uIjoiTGFyYXZlbCBTZXJ2aWNlIENvbnRhaW5lciBiaW5kaW5nIHNpbmdsZXRvbiBraMOhYyBnw6wgYmluZCB0aMaw4budbmc/IiwiY2F0ZWdvcnkiOiJMYXJhdmVsIiwiZGlmZmljdWx0eSI6Ik1pZGRsZSIsInR5cGUiOiJUcuG6r2MgbmdoaeG7h20iLCJ0YWdzIjpbIlNlcnZpY2UgQ29udGFpbmVyIiwiU2luZ2xldG9uIiwiREkiXSwib3B0aW9ucyI6W3sibGFiZWwiOiJBIiwidGV4dCI6InNpbmdsZXRvbiB04bqhbyAxIGluc3RhbmNlIGR1eSBuaOG6pXQgY2hvIGPhuqMgbGlmZWN5Y2xlLCBiaW5kIHThuqFvIG3hu5tpIG3hu5dpIGzhuqduIHJlc29sdmUifSx7ImxhYmVsIjoiQiIsInRleHQiOiJzaW5nbGV0b24gY2jhu4kgZMO5bmcgY2hvIGNvbmZpZyJ9LHsibGFiZWwiOiJDIiwidGV4dCI6ImJpbmQgbmhhbmggaMahbiBzaW5nbGV0b24ifSx7ImxhYmVsIjoiRCIsInRleHQiOiJLaMO0bmcgY8OzIGtow6FjIGJp4buHdCJ9XSwiY29ycmVjdCI6IkEiLCJleHBsYW5hdGlvbiI6InNpbmdsZXRvbiBkw7luZyBjaG8gc2VydmljZSBzdGF0ZWxlc3MsIG7hurduZyBraOG7n2kgdOG6oW8gKHZkOiBSZWRpcyBjbGllbnQpLiBiaW5kIGTDuW5nIGNobyBzZXJ2aWNlIGPDsyBzdGF0ZSByacOqbmcgbeG7l2kgbOG6p24gZMO5bmcuIE5nb8OgaSByYSBjw7Mgc2NvcGVkIGNobyByZXF1ZXN0IGxpZmVjeWNsZS4ifSx7ImlkIjoiU0VDLTAxNiIsInF1ZXN0aW9uIjoiU28gc8OhbmggSldUIHZzIFNlc3Npb24gY2hvIEFQSSBhdXRoZW50aWNhdGlvbiwga2hpIG7DoG8gZMO5bmcgSldUPyIsImNhdGVnb3J5IjoiU3lzdGVtIEFkbWluICYgU2VjdXJpdHkiLCJkaWZmaWN1bHR5IjoiTWlkZGxlIiwidHlwZSI6IlRy4bqvYyBuZ2hp4buHbSIsInRhZ3MiOlsiSldUIiwiU2Vzc2lvbiIsIkF1dGgiLCJTZWN1cml0eSJdLCJvcHRpb25zIjpbeyJsYWJlbCI6IkEiLCJ0ZXh0IjoiSldUIGx1w7RuIHThu5F0IGjGoW4gU2Vzc2lvbiJ9LHsibGFiZWwiOiJCIiwidGV4dCI6IkpXVCBzdGF0ZWxlc3MsIHBow7kgaOG7o3AgbWljcm9zZXJ2aWNlcy9tb2JpbGUsIG5oxrBuZyBraMOzIHJldm9rZSwgbsOqbiBkw7luZyBzaG9ydC1saXZlZCArIHJlZnJlc2ggdG9rZW4ifSx7ImxhYmVsIjoiQyIsInRleHQiOiJTZXNzaW9uIGtow7RuZyBkw7luZyDEkcaw4bujYyBjaG8gQVBJIn0seyJsYWJlbCI6IkQiLCJ0ZXh0IjoiSldUIGzGsHUgdHJvbmcgbG9jYWxTdG9yYWdlIGzDoCBhbiB0b8OgbiBuaOG6pXQifV0sImNvcnJlY3QiOiJCIiwiZXhwbGFuYXRpb24iOiJKV1QgcHJvczogc3RhdGVsZXNzLCBzY2FsZSB04buRdC4gQ29uczoga2jDtG5nIHJldm9rZSBuZ2F5IMSRxrDhu6NjLCBwYXlsb2FkIGzhu5tuLiBCZXN0IHByYWN0aWNlOiBhY2Nlc3MgdG9rZW4gMTUgcGjDunQsIHJlZnJlc2ggdG9rZW4gaHR0cE9ubHkgY29va2llLCBibGFja2xpc3Qga2hpIGxvZ291dCBi4bqxbmcgUmVkaXMuIn0seyJpZCI6IkRCLTAxNyIsInF1ZXN0aW9uIjoiR2nhuqNpIHRow61jaCBoaeG7h24gdMaw4bujbmcgR2l0IGNvbmZsaWN0IGtoaSBtZXJnZSB2w6AgY8OhY2ggcmVzb2x2ZSBhbiB0b8Ogbj8iLCJjYXRlZ29yeSI6IlBIUCBDb3JlIiwiZGlmZmljdWx0eSI6Ikp1bmlvciIsInR5cGUiOiJUw6xuaCBodeG7kW5nIiwidGFncyI6WyJHaXQiLCJDb25mbGljdCIsIldvcmtmbG93Il0sIm9wdGlvbnMiOlt7ImxhYmVsIjoiQSIsInRleHQiOiJYw7NhIGZpbGUgYuG7iyBjb25mbGljdCB2w6AgY29tbWl0IGzhuqFpIn0seyJsYWJlbCI6IkIiLCJ0ZXh0IjoiTeG7nyBmaWxlLCB0w6xtIDw8PDw8PDwsIGNo4buNbiBjb2RlIMSRw7puZywgdGVzdCBs4bqhaSwgZ2l0IGFkZCB2w6AgY29tbWl0In0seyJsYWJlbCI6IkMiLCJ0ZXh0IjoiRMO5bmcgZ2l0IHJlc2V0IC0taGFyZCDEkeG7gyBi4buPIGNvbmZsaWN0In0seyJsYWJlbCI6IkQiLCJ0ZXh0IjoiS2jDtG5nIHRo4buDIHJlc29sdmUgY29uZmxpY3QifV0sImNvcnJlY3QiOiJCIiwiZXhwbGFuYXRpb24iOiJRdXkgdHLDrG5oOiBnaXQgc3RhdHVzIHhlbSBmaWxlIGNvbmZsaWN0LCBt4bufIGVkaXRvciwgcXV54bq/dCDEkeG7i25oIGdp4buvIGNvZGUgbsOgbyBob+G6t2MgbWVyZ2UgdGjhu6cgY8O0bmcsIHjDs2EgbWFya2VyIDw8PDwgPT09PSA+Pj4+LCBjaOG6oXkgdGVzdCwgZ2l0IGFkZCwgZ2l0IGNvbW1pdC4gRMO5bmcgbWVyZ2V0b29sIG7hur91IGPhuqduLiIsInNjZW5hcmlvIjoiMiBkZXYgY8O5bmcgc+G7rWEgY8O5bmcgZMOybmcgdHJvbmcgVXNlci5waHAuIEPhuqduIHRyYW8gxJHhu5VpIMSR4buDIGhp4buDdSBsb2dpYywga2jDtG5nIHThu7Egw70gY2jhu41uIDEgYsOqbi4ifSx7ImlkIjoiUEVSRi0wMTgiLCJxdWVzdGlvbiI6Ik9QY2FjaGUgdHJvbmcgUEhQIGdpw7pwIGfDrCB2w6AgY+G6pXUgaMOsbmggcXVhbiB0cuG7jW5nPyIsImNhdGVnb3J5IjoiT09QL1BlcmZvcm1hbmNlIiwiZGlmZmljdWx0eSI6Ik1pZGRsZSIsInR5cGUiOiJUcuG6r2MgbmdoaeG7h20iLCJ0YWdzIjpbIk9QY2FjaGUiLCJQZXJmb3JtYW5jZSIsIlBIUCJdLCJvcHRpb25zIjpbeyJsYWJlbCI6IkEiLCJ0ZXh0IjoiQ2FjaGUga+G6v3QgcXXhuqMgcXVlcnkifSx7ImxhYmVsIjoiQiIsInRleHQiOiJDYWNoZSBvcGNvZGUgxJHDoyBiacOqbiBk4buLY2gsIGdp4bqjbSB0aOG7nWkgZ2lhbiBwYXJzZSBQSFAsIGPhuqV1IGjDrG5oIG9wY2FjaGUubWVtb3J5X2NvbnN1bXB0aW9uLCB2YWxpZGF0ZV90aW1lc3RhbXBzPTAg4bufIHByb2R1Y3Rpb24ifSx7ImxhYmVsIjoiQyIsInRleHQiOiJDYWNoZSBzZXNzaW9uIn0seyJsYWJlbCI6IkQiLCJ0ZXh0IjoiS2jDtG5nIGPhuqduIHRoaeG6v3QgduG7m2kgUEhQIDgifV0sImNvcnJlY3QiOiJCIiwiZXhwbGFuYXRpb24iOiJPUGNhY2hlIGzGsHUgYnl0ZWNvZGUsIHTEg25nIHBlcmZvcm1hbmNlIDMtNXguIFByb2R1Y3Rpb246IG9wY2FjaGUudmFsaWRhdGVfdGltZXN0YW1wcz0wIChraMO0bmcgY2hlY2sgZmlsZSBtdGltZSBt4buXaSByZXF1ZXN0KSwgb3BjYWNoZS5tYXhfYWNjZWxlcmF0ZWRfZmlsZXMgxJHhu6cgbOG7m24sIHByZWxvYWQgY2hvIFBIUCA3LjQrLiJ9LHsiaWQiOiJMQVItMDE5IiwicXVlc3Rpb24iOiJMYXJhdmVsIEhvcml6b24gZMO5bmcgxJHhu4MgbMOgbSBnw6wgdsOgIGzhu6NpIMOtY2ggc28gduG7m2kgcXVldWU6d29yayB0aMaw4budbmc/IiwiY2F0ZWdvcnkiOiJMYXJhdmVsIiwiZGlmZmljdWx0eSI6IlNlbmlvciIsInR5cGUiOiJUcuG6r2MgbmdoaeG7h20iLCJ0YWdzIjpbIkhvcml6b24iLCJRdWV1ZSIsIk1vbml0b3JpbmciXSwib3B0aW9ucyI6W3sibGFiZWwiOiJBIiwidGV4dCI6IlRoYXkgdGjhur8gaG/DoG4gdG/DoG4gUmVkaXMifSx7ImxhYmVsIjoiQiIsInRleHQiOiJEYXNoYm9hcmQgZ2nDoW0gc8OhdCBxdWV1ZSwgYXV0by1zY2FsaW5nIHdvcmtlcnMsIHJldHJ5IGZhaWxlZCwgbWV0cmljcywgYmFsYW5jaW5nIHN0cmF0ZWd5In0seyJsYWJlbCI6IkMiLCJ0ZXh0IjoiQ2jhu4kgZMO5bmcgxJHhu4MgZ+G7rWkgbWFpbCJ9LHsibGFiZWwiOiJEIiwidGV4dCI6Iktow7RuZyBjw7MgbOG7o2kgw61jaCBnw6wifV0sImNvcnJlY3QiOiJCIiwiZXhwbGFuYXRpb24iOiJIb3Jpem9uIGN1bmcgY+G6pXAgVUkgxJHhurlwLCBjb25maWcgc3VwZXJ2aXNvciwgY8OibiBi4bqxbmcgcXVldWUgKHNpbXBsZS9hdXRvKSwgcGF1c2UvcmVzdW1lIHF1ZXVlLCB4ZW0gdGhyb3VnaHB1dCwgcnVudGltZSwgZmFpbGVkIGpvYnMuIELhuq90IGJ14buZYyBjaG8gaOG7hyB0aOG7kW5nIHF1ZXVlIGzhu5tuLiJ9LHsiaWQiOiJPT1AtMDIwIiwicXVlc3Rpb24iOiJUcm9uZyBQSFBVbml0LCBraGkgbsOgbyBkw7luZyBNb2NrIHZzIFN0dWIgdnMgRmFrZSB0cm9uZyBMYXJhdmVsIHRlc3Rpbmc/IiwiY2F0ZWdvcnkiOiJPT1AvUGVyZm9ybWFuY2UiLCJkaWZmaWN1bHR5IjoiTWlkZGxlIiwidHlwZSI6IkNvZGUiLCJ0YWdzIjpbIlRlc3RpbmciLCJNb2NrIiwiUEhQVW5pdCJdLCJvcHRpb25zIjpbeyJsYWJlbCI6IkEiLCJ0ZXh0IjoiRMO5bmcgZ2nhu5FuZyBuaGF1LCBjaOG7iSBraMOhYyB0w6puIn0seyJsYWJlbCI6IkIiLCJ0ZXh0IjoiTW9jayBraeG7g20gdHJhIGludGVyYWN0aW9uIChtZXRob2QgxJHGsOG7o2MgZ+G7jWkpLCBTdHViIHRy4bqjIHbhu4EgZOG7ryBsaeG7h3UgZ2nhuqMsIEZha2UgbMOgIGltcGxlbWVudGF0aW9uIG5o4bq5ICh2ZDogTWFpbDo6ZmFrZSgpKSJ9LHsibGFiZWwiOiJDIiwidGV4dCI6IkNo4buJIG7Dqm4gZMO5bmcgTW9jayJ9LHsibGFiZWwiOiJEIiwidGV4dCI6IlRlc3Rpbmcga2jDtG5nIGPhuqduIHRoaeG6v3QifV0sImNvcnJlY3QiOiJCIiwiZXhwbGFuYXRpb24iOiJNb2NrOiAkbW9jay0+ZXhwZWN0cygkdGhpcy0+b25jZSgpKS0+bWV0aG9kKFwic2VuZFwiKS4gU3R1YjogdHLhuqMgduG7gSBnacOhIHRy4buLIGPhu5EgxJHhu4tuaC4gRmFrZTogTGFyYXZlbCBjdW5nIGPhuqVwIGNobyBRdWV1ZSwgTWFpbCwgU3RvcmFnZSDEkeG7gyB0ZXN0IG3DoCBraMO0bmcgZ+G7rWkgdGjhuq10LiBEw7luZyBSZWZyZXNoRGF0YWJhc2UgY2hvIHRlc3QgaXNvbGF0aW9uLiIsImNvZGVTbmlwcGV0IjoiTWFpbDo6ZmFrZSgpO1xuLy8gYWN0aW9uXG5NYWlsOjphc3NlcnRTZW50KEludm9pY2VNYWlsOjpjbGFzcyk7In0seyJpZCI6IlBIUC0wMjEiLCJxdWVzdGlvbiI6IlBIUCA4IEZpYmVycyBkw7luZyDEkeG7gyBnaeG6o2kgcXV54bq/dCB24bqlbiDEkeG7gSBnw6w/IiwiY2F0ZWdvcnkiOiJQSFAgQ29yZSIsImRpZmZpY3VsdHkiOiJTZW5pb3IiLCJ0eXBlIjoiVHLhuq9jIG5naGnhu4dtIiwidGFncyI6WyJQSFAgOC4xIiwiRmliZXJzIiwiQXN5bmMiXSwib3B0aW9ucyI6W3sibGFiZWwiOiJBIiwidGV4dCI6IlTEg25nIHThu5FjIMSR4buZIHjhu60gbMO9IHN0cmluZyJ9LHsibGFiZWwiOiJCIiwidGV4dCI6IkNobyBwaMOpcCBjb29wZXJhdGl2ZSBtdWx0aXRhc2tpbmcsIHN1c3BlbmQvcmVzdW1lIGNvZGUsIG7hu4FuIHThuqNuZyBjaG8gYXN5bmMgZnJhbWV3b3JrIn0seyJsYWJlbCI6IkMiLCJ0ZXh0IjoiVGhheSB0aOG6vyBjaG8gR2VuZXJhdG9ycyJ9LHsibGFiZWwiOiJEIiwidGV4dCI6IkNo4buJIGTDuW5nIGNobyBMYXJhdmVsIn1dLCJjb3JyZWN0IjoiQiIsImV4cGxhbmF0aW9uIjoiRmliZXJzIGNobyBwaMOpcCB04bqhbSBk4burbmcgZnVuY3Rpb24g4bufIGdp4buvYSB2w6AgcmVzdW1lIHNhdSwgZ2nDunAgdmnhur90IGFzeW5jIGNvZGUgdGhlbyBraeG7g3UgxJHhu5NuZyBi4buZLiBMw6AgbuG7gW4gdOG6o25nIGNobyBSZXZvbHQsIEFtcCwgTGFyYXZlbCBPY3RhbmUuIn0seyJpZCI6IkRCLTAyMiIsInF1ZXN0aW9uIjoiTXlTUUwgdHJhbnNhY3Rpb24gaXNvbGF0aW9uIGxldmVsIG7DoG8gdHLDoW5oIMSRxrDhu6NjIHBoYW50b20gcmVhZD8iLCJjYXRlZ29yeSI6Ik15U1FML0RhdGFiYXNlIiwiZGlmZmljdWx0eSI6IlNlbmlvciIsInR5cGUiOiJUcuG6r2MgbmdoaeG7h20iLCJ0YWdzIjpbIklzb2xhdGlvbiIsIlRyYW5zYWN0aW9uIiwiTXlTUUwiXSwib3B0aW9ucyI6W3sibGFiZWwiOiJBIiwidGV4dCI6IlJFQUQgVU5DT01NSVRURUQifSx7ImxhYmVsIjoiQiIsInRleHQiOiJSRUFEIENPTU1JVFRFRCJ9LHsibGFiZWwiOiJDIiwidGV4dCI6IlJFUEVBVEFCTEUgUkVBRCAoSW5ub0RCIGRlZmF1bHQpIGTDuW5nIGdhcCBsb2NrLCBTRVJJQUxJWkFCTEUgY8WpbmcgdHLDoW5oIMSRxrDhu6NjIn0seyJsYWJlbCI6IkQiLCJ0ZXh0IjoiS2jDtG5nIGxldmVsIG7DoG8gdHLDoW5oIMSRxrDhu6NjIn1dLCJjb3JyZWN0IjoiQyIsImV4cGxhbmF0aW9uIjoiSW5ub0RCIFJFUEVBVEFCTEUgUkVBRCBkw7luZyBuZXh0LWtleSBsb2NrIChyZWNvcmQgKyBnYXAgbG9jaykgxJHhu4MgdHLDoW5oIHBoYW50b20gcmVhZCwga2jDoWMgduG7m2kgY2h14bqpbiBTUUwuIFNFUklBTElaQUJMRSBraMOzYSBt4bqhbmggaMahbi4gUkVBRCBDT01NSVRURUQgduG6q24gY8OzIHBoYW50b20gcmVhZC4ifSx7ImlkIjoiU1lTLTAyMyIsInF1ZXN0aW9uIjoiS2hpIGRlcGxveSBMYXJhdmVsLCB04bqhaSBzYW8gcGjhuqNpIGNo4bqheSBwaHAgYXJ0aXNhbiBjb25maWc6Y2FjaGUgdsOgIHJvdXRlOmNhY2hlPyIsImNhdGVnb3J5IjoiU3lzdGVtIEFkbWluICYgU2VjdXJpdHkiLCJkaWZmaWN1bHR5IjoiSnVuaW9yIiwidHlwZSI6IlRy4bqvYyBuZ2hp4buHbSIsInRhZ3MiOlsiRGVwbG95IiwiQ2FjaGUiLCJMYXJhdmVsIl0sIm9wdGlvbnMiOlt7ImxhYmVsIjoiQSIsInRleHQiOiLEkOG7gyBsw6BtIMSR4bq5cCBjb2RlIn0seyJsYWJlbCI6IkIiLCJ0ZXh0IjoiR+G7mXAgY29uZmlnIHbDoCByb3V0ZSB0aMOgbmggZmlsZSBjYWNoZSwgZ2nhuqNtIEkvTyB2w6AgdMSDbmcgdOG7kWMgYm9vdHN0cmFwLCBwaOG6o2kgY2jhuqF5IHNhdSBt4buXaSBkZXBsb3kifSx7ImxhYmVsIjoiQyIsInRleHQiOiJDaOG7iSBj4bqnbiBraGkgZMO5bmcgUmVkaXMifSx7ImxhYmVsIjoiRCIsInRleHQiOiJLaMO0bmcgYmFvIGdp4budIG7Dqm4gY2FjaGUifV0sImNvcnJlY3QiOiJCIiwiZXhwbGFuYXRpb24iOiJjb25maWc6Y2FjaGUgZ2nhuqNtIHZp4buHYyDEkeG7jWMgaMOgbmcgY2jhu6VjIGZpbGUgY29uZmlnIG3hu5dpIHJlcXVlc3QuIHJvdXRlOmNhY2hlIHTGsMahbmcgdOG7sS4gTMawdSDDvTogbuG6v3UgZMO5bmcgZW52KCkgbmdvw6BpIGNvbmZpZyBmaWxlIHPhur0gbOG7l2kgc2F1IGtoaSBjYWNoZSwgcGjhuqNpIGTDuW5nIGNvbmZpZygpLiJ9LHsiaWQiOiJQRVJGLTAyNCIsInF1ZXN0aW9uIjoiTMOgbSBzYW8gcGjDoXQgaGnhu4duIG1lbW9yeSBsZWFrIHRyb25nIFBIUCBsb25nLXJ1bm5pbmcgcHJvY2VzcyAocXVldWUgd29ya2VyKT8iLCJjYXRlZ29yeSI6Ik9PUC9QZXJmb3JtYW5jZSIsImRpZmZpY3VsdHkiOiJTZW5pb3IiLCJ0eXBlIjoiVMOsbmggaHXhu5FuZyIsInRhZ3MiOlsiTWVtb3J5IExlYWsiLCJRdWV1ZSIsIlBlcmZvcm1hbmNlIl0sIm9wdGlvbnMiOlt7ImxhYmVsIjoiQSIsInRleHQiOiJUxINuZyBtZW1vcnlfbGltaXQgbMOqbiAyR0IifSx7ImxhYmVsIjoiQiIsInRleHQiOiJEw7luZyBtZW1vcnlfZ2V0X3VzYWdlKCksIGdjX2NvbGxlY3RfY3ljbGVzKCksIGhvcml6b24gbWVtb3J5IGxpbWl0LCBxdWV1ZTpyZXN0YXJ0IHNhdSBt4buXaSBOIGpvYnMsIHRyw6FuaCBzdGF0aWMgY2FjaGUgbOG7m24ifSx7ImxhYmVsIjoiQyIsInRleHQiOiJNZW1vcnkgbGVhayBraMO0bmcgeOG6o3kgcmEgduG7m2kgUEhQIn0seyJsYWJlbCI6IkQiLCJ0ZXh0IjoiUmVzdGFydCBzZXJ2ZXIgbeG7l2kgZ2nhu50ifV0sImNvcnJlY3QiOiJCIiwiZXhwbGFuYXRpb24iOiJOZ3V5w6puIG5ow6JuIHBo4buVIGJp4bq/bjogRWxvcXVlbnQgZ2nhu68gbW9kZWwgdHJvbmcgbWVtb3J5LCBldmVudCBsaXN0ZW5lciBraMO0bmcgZGV0YWNoLCBjaXJjdWxhciByZWZlcmVuY2UuIEdp4bqjaSBwaMOhcDogLS1tYXgtam9icywgLS1tYXgtdGltZSB0cm9uZyBIb3Jpem9uLCBkw7luZyBjdXJzb3IoKSB0aGF5IGdldCgpIGNobyBsYXJnZSBkYXRhc2V0LCB1bnNldCBiaeG6v24gbOG7m24uIn1d'), true);
$categories = array_values(array_unique(array_column($questions, 'category')));
$difficulties = array_values(array_unique(array_column($questions, 'difficulty')));
$types = array_values(array_unique(array_column($questions, 'type')));
$totalQuestions = count($questions);
?>
<!doctype html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>PHP Interview Hub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --p: #6d5dfc;
            --p2: #4f46e5;
            --bg: #f5f7fb;
            --ink: #172033;
            --muted: #718096;
            --border: #e7eaf0;
            --side: 258px
        }

        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--ink);
            font: 14px Inter, system-ui, sans-serif
        }

        .sidebar {
            position: fixed;
            z-index: 1040;
            inset: 0 auto 0 0;
            width: var(--side);
            padding: 22px 15px;
            background: #101426;
            color: #fff;
            transition: .25s;
            box-shadow: 8px 0 28px #10142612
        }

        .brand {
            display: flex;
            gap: 11px;
            align-items: center;
            padding: 5px 8px 27px
        }

        .brand i {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            border-radius: 13px;
            background: linear-gradient(135deg, #8174ff, #4637dc);
            font-size: 20px
        }

        .brand b {
            display: block;
            font-size: 15px
        }

        .brand small {
            color: #929bb1
        }

        .nav-title {
            font-size: 10px;
            color: #69738a;
            text-transform: uppercase;
            letter-spacing: .13em;
            padding: 0 10px 8px
        }

        .nav-btn {
            border: 0;
            background: transparent;
            color: #aeb6ca;
            width: 100%;
            padding: 11px 12px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 11px;
            text-align: left;
            font-weight: 600;
            margin-bottom: 4px
        }

        .nav-btn:hover {
            background: #1b2035;
            color: #fff
        }

        .nav-btn.active {
            background: linear-gradient(135deg, var(--p), var(--p2));
            color: #fff;
            box-shadow: 0 10px 22px #4f46e544
        }

        .nav-btn .badge {
            margin-left: auto;
            background: #ffffff1c
        }

        .tip {
            margin-top: auto;
            padding: 15px;
            border-radius: 17px;
            background: linear-gradient(145deg, #211c58, #171b3d);
            border: 1px solid #ffffff12
        }

        .tip button {
            font-size: 12px;
            font-weight: 700
        }

        .main {
            margin-left: var(--side);
            min-height: 100vh
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: #ffffffe8;
            backdrop-filter: blur(14px);
            border-bottom: 1px solid var(--border)
        }

        .topbar-in {
            min-height: 72px;
            padding: 12px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px
        }

        .title {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: -.04em
        }

        .subtitle {
            font-size: 12px;
            color: var(--muted);
            margin-top: 2px
        }

        .status {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 11px;
            border: 1px solid var(--border);
            background: #f3f5f8;
            border-radius: 11px;
            font-size: 12px;
            font-weight: 600
        }

        .dot {
            width: 7px;
            height: 7px;
            background: #10b981;
            border-radius: 50%;
            box-shadow: 0 0 0 4px #10b98118
        }

        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: linear-gradient(135deg, #ffbd4a, #f97316);
            display: grid;
            place-items: center;
            color: #fff;
            font-weight: 800
        }

        .content {
            padding: 26px 28px 45px
        }

        .cardx {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: 0 8px 25px #16203709
        }

        .stat {
            padding: 18px;
            height: 100%
        }

        .stat-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .12em;
            font-weight: 800;
            color: #8490a6
        }

        .stat-value {
            font-size: 29px;
            font-weight: 800;
            letter-spacing: -.04em
        }

        .stat-sub {
            font-size: 11px;
            color: var(--muted)
        }

        .ico {
            width: 43px;
            height: 43px;
            border-radius: 13px;
            color: #fff;
            display: grid;
            place-items: center;
            font-size: 18px
        }

        .g1 {
            background: linear-gradient(135deg, #7c6cff, #4f46e5)
        }

        .g2 {
            background: linear-gradient(135deg, #3182ce, #0891b2)
        }

        .g3 {
            background: linear-gradient(135deg, #d946ef, #7c3aed)
        }

        .g4 {
            background: linear-gradient(135deg, #10b981, #0d9488)
        }

        .panel {
            padding: 20px
        }

        .panel h3 {
            font-size: 14px;
            font-weight: 800;
            margin: 0
        }

        .panel-sub {
            font-size: 11px;
            color: var(--muted)
        }

        .progress {
            height: 6px
        }

        .progress-bar {
            background: linear-gradient(90deg, var(--p), var(--p2))
        }

        .cat {
            display: grid;
            grid-template-columns: 165px 1fr 60px;
            gap: 12px;
            align-items: center;
            margin: 15px 0
        }

        .cat-name {
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap
        }

        .cat-bar {
            height: 8px;
            border-radius: 20px;
            background: #edf0f5;
            overflow: hidden
        }

        .cat-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--p), var(--p2));
            border-radius: 20px
        }

        .qitem {
            padding: 13px 0;
            border-bottom: 1px solid #f0f2f6
        }

        .qitem:last-child {
            border: 0
        }

        .qid {
            font: 700 10px 'JetBrains Mono';
            background: #056334;
            color: #fff;
            border-radius: 7px;
            padding: 5px 7px
        }

        .qtitle {
            font-size: 12.5px;
            font-weight: 600;
            line-height: 1.45
        }

        .tag {
            display: inline-block;
            background: #f7f8fa;
            border: 1px solid var(--border);
            color: #677287;
            border-radius: 999px;
            padding: 3px 7px;
            font-size: 9px;
            margin: 2px 3px 0 0
        }

        .diff {
            font-size: 10px;
            font-weight: 700;
            border-radius: 999px;
            padding: 4px 8px;
            border: 1px solid
        }

        .junior {
            background: #ecfdf5;
            color: #047857;
            border-color: #a7f3d0
        }

        .middle {
            background: #fffbeb;
            color: #b45309;
            border-color: #fde68a
        }

        .senior {
            background: #fff1f2;
            color: #be123c;
            border-color: #fecdd3
        }

        .hero {
            background: linear-gradient(145deg, #111827, #20263b);
            color: #fff
        }

        .hero .mini {
            background: #ffffff0d;
            border: 1px solid #ffffff12;
            border-radius: 12px;
            padding: 9px;
            text-align: center
        }

        .hero .mini strong {
            display: block;
            font-size: 16px
        }

        .hero .mini span {
            font-size: 9px;
            color: #9da6b9
        }

        .quick {
            border: 1px solid var(--border);
            background: #fff;
            border-radius: 12px;
            padding: 11px;
            text-align: left;
            font-size: 11px;
            font-weight: 700
        }

        .quick:hover {
            background: #f6f4ff;
            border-color: #c8c2ff
        }

        .toolbar {
            padding: 14px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 18px
        }

        .form-control,
        .form-select {
            font-size: 12px;
            border-radius: 11px;
            border-color: #e1e5ec;
            padding: 10px 12px
        }

        .question-table {
            overflow: hidden
        }

        .table {
            margin: 0
        }

        .table th {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: #7a8497;
            background: #f8f9fb;
            padding: 12px
        }

        .table td {
            padding: 13px 12px;
            border-color: #f0f2f6
        }

        .table tbody tr:hover {
            background: #faf9ff
        }

        .table-question {
            font-size: 12.5px;
            font-weight: 600;
            line-height: 1.4;
            max-width: 720px
        }

        .mono {
            font-family: 'JetBrains Mono', monospace
        }

        .btn-main {
            background: linear-gradient(135deg, var(--p), var(--p2));
            border: 0;
            color: #fff;
            border-radius: 11px;
            padding: 10px 15px;
            font-weight: 700
        }

        .btn-main:hover {
            color: #fff;
            filter: brightness(.96)
        }

        .exam {
            max-width: 980px;
            margin: auto;
            padding: 28px
        }

        .exam-icon {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            background: #eeeaff;
            color: #5b4cf0;
            display: grid;
            place-items: center;
            font-size: 25px
        }

        .exam h2 {
            font-size: 27px;
            font-weight: 800;
            letter-spacing: -.04em
        }

        .feature {
            background: #f8f9fb;
            border: 1px solid var(--border);
            border-radius: 13px;
            padding: 12px;
            text-align: center
        }

        .feature strong {
            display: block
        }

        .feature span {
            font-size: 10px;
            color: var(--muted)
        }

        .score {
            width: 76px;
            height: 76px;
            border-radius: 50%;
            display: grid;
            place-items: center;
            background: #f0eeff;
            color: #5b4cf0;
            font-size: 21px;
            font-weight: 800
        }

        .config-row {
            padding: 14px 0;
            border-bottom: 1px solid #f0f2f6
        }

        .modal-content {
            border: 0;
            border-radius: 20px;
            overflow: hidden
        }

        .modal-header {
            background: #101426;
            color: #fff;
            border: 0
        }

        .code {
            background: #111827;
            color: #d7def0;
            border-radius: 12px;
            padding: 14px;
            font: 11px/1.65 'JetBrains Mono';
            white-space: pre-wrap;
            max-height: 260px;
            overflow: auto
        }

        .answer {
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 11px;
            margin-bottom: 8px
        }

        .answer.correct {
            border-color: #86efac;
            background: #f0fdf4
        }

        .empty {
            text-align: center;
            padding: 45px;
            color: var(--muted)
        }

        .mobile {
            display: none
        }

        .section {
            animation: in .2s ease
        }

        @keyframes in {
            from {
                opacity: 0;
                transform: translateY(5px)
            }

            to {
                opacity: 1;
                transform: none
            }
        }

        @media(max-width:991px) {
            :root {
                --side: 0px
            }

            .sidebar {
                transform: translateX(-270px);
                width: 260px
            }

            .sidebar.show {
                transform: none
            }

            .main {
                margin-left: 0
            }

            .mobile {
                display: grid;
                place-items: center;
                width: 38px;
                height: 38px;
                border: 0;
                border-radius: 11px;
                background: #111827;
                color: #fff
            }

            .topbar-in,
            .content {
                padding-left: 16px;
                padding-right: 16px
            }

            .cat {
                grid-template-columns: 130px 1fr 50px
            }
        }

        @media(max-width:575px) {
            .status {
                display: none
            }

            .title {
                font-size: 16px
            }

            .content {
                padding-top: 18px
            }

            .cat {
                grid-template-columns: 105px 1fr 45px;
                gap: 8px
            }

            .exam {
                padding: 20px
            }

            .exam h2 {
                font-size: 22px
            }
        }
    </style>
</head>

<body>
    <aside class="sidebar" id="sidebar">
        <div class="brand"><i class="bi bi-code-slash"></i>
            <div><b>PHP Interview Hub</b><small>Question Bank v3.0</small></div>
        </div>
        <div class="nav-title">Workspace</div>
        <nav>
            <button class="nav-btn active" data-page="dashboard"><i
                    class="bi bi-grid-1x2-fill"></i>Dashboard</button><button class="nav-btn" data-page="questions"><i
                    class="bi bi-database"></i>Ngân hàng câu hỏi <span
                    class="badge rounded-pill"><?php echo $totalQuestions; ?></span></button><button class="nav-btn"
                data-page="exam"><i class="bi bi-file-earmark-text"></i>Đề thi & Thi thử</button><button class="nav-btn"
                data-page="results"><i class="bi bi-bar-chart-fill"></i>Kết quả</button><button class="nav-btn"
                data-page="config"><i class="bi bi-sliders2"></i>Cấu hình</button>
        </nav>
        <div class="tip mt-auto">
            <div class="fw-bold small"><i class="bi bi-stars me-1"></i>Pro Tip</div>
            <div class="small text-white-50 my-2">Thi thử 20 câu ngẫu nhiên để đánh giá nhanh level.</div><button
                class="btn btn-light w-100" onclick="startExam()">Bắt đầu thi ngay</button>
        </div>
    </aside>
    <div class="main">
        <header class="topbar">
            <div class="topbar-in">
                <div class="d-flex align-items-center gap-3"><button class="mobile" id="toggle"><i
                            class="bi bi-list"></i></button>
                    <div>
                        <div class="title" id="title">Dashboard tổng quan</div>
                        <div class="subtitle">Quản lý <?php echo $totalQuestions; ?> câu hỏi tuyển dụng PHP Developer
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <div class="status"><span class="dot"></span>Hệ thống hoạt động</div>
                    <div class="avatar">AD</div>
                </div>
            </div>
        </header>
        <main class="content">
            <section id="dashboard" class="section">
                <div class="row g-3 mb-4" id="stats"></div>
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="cardx panel h-100">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>Phân bổ theo danh mục</h3>
                                    <div class="panel-sub">Tỷ trọng câu hỏi hiện tại</div>
                                </div><span class="badge text-bg-light" id="catTotal"></span>
                            </div>
                            <div id="cats"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cardx panel hero h-100">
                            <div class="small text-white-50 text-uppercase fw-bold">Interview readiness</div>
                            <h3 class="mt-2">Sẵn sàng phỏng vấn?</h3>
                            <p class="small text-white-50 lh-lg">N+1, Redis Stampede, 502, Deadlock, XSS, SQL Injection,
                                Docker, Performance...</p>
                            <div class="row g-2" id="levels"></div><button class="btn btn-light w-100 mt-3 fw-bold"
                                onclick="startExam()"><i class="bi bi-play-fill"></i> Thi thử 20 câu</button>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="cardx panel">
                            <div class="d-flex justify-content-between">
                                <h3>Câu hỏi mới cập nhật</h3><button class="btn btn-sm btn-link"
                                    onclick="go('questions')">Xem tất cả</button>
                            </div>
                            <div id="recent"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cardx panel">
                            <h3>Quick actions</h3>
                            <div class="d-grid gap-2 mt-3"><button class="quick" onclick="go('questions')"><i
                                        class="bi bi-search me-2 text-primary"></i>Tra cứu ngân hàng</button><button
                                    class="quick" onclick="startExam()"><i
                                        class="bi bi-lightning-charge me-2 text-warning"></i>Thi thử ngẫu
                                    nhiên</button><button class="quick" onclick="go('results')"><i
                                        class="bi bi-graph-up-arrow me-2 text-success"></i>Xem lịch sử kết quả</button>
                            </div>
                            <div class="alert alert-warning small mt-3 mb-0">💡 Hiện có
                                <b><?php echo $totalQuestions; ?></b> câu. Có thể mở rộng trực tiếp trong PHP.
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="questions" class="section d-none">
                <div class="toolbar mb-3">
                    <div class="row g-2">
                        <div class="col-lg-5">
                            <div class="input-group"><span class="input-group-text"><i
                                        class="bi bi-search"></i></span><input id="search" class="form-control"
                                    placeholder="Tìm ID, nội dung, tags..."></div>
                        </div>
                        <div class="col-md-4 col-lg-2"><select id="cat" class="form-select">
                                <option value="">Tất cả danh mục</option><?php foreach ($categories as $v): ?>
                                    <option><?php echo htmlspecialchars($v); ?></option><?php endforeach; ?>
                            </select></div>
                        <div class="col-md-4 col-lg-2"><select id="diff" class="form-select">
                                <option value="">Tất cả cấp độ</option><?php foreach ($difficulties as $v): ?>
                                    <option><?php echo htmlspecialchars($v); ?></option><?php endforeach; ?>
                            </select></div>
                        <div class="col-md-4 col-lg-2"><select id="type" class="form-select">
                                <option value="">Tất cả loại</option><?php foreach ($types as $v): ?>
                                    <option><?php echo htmlspecialchars($v); ?></option><?php endforeach; ?>
                            </select></div>
                        <div class="col-lg-1"><button class="btn btn-light border w-100" onclick="resetFilter()"><i
                                    class="bi bi-arrow-counterclockwise"></i></button></div>
                    </div>
                    <div class="small text-secondary mt-3" id="count"></div>
                </div>
                <div class="cardx question-table">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Câu hỏi</th>
                                    <th class="d-none d-lg-table-cell">Danh mục</th>
                                    <th>Độ khó</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="rows"></tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-between align-items-center p-3 bg-light border-top"><small
                            id="pageInfo" class="text-secondary"></small>
                        <ul class="pagination pagination-sm mb-0" id="pagination"></ul>
                    </div>
                </div>
            </section>
            <section id="exam" class="section d-none">
                <div class="cardx exam">
                    <div id="examSetup">
                        <div class="row g-4 align-items-center">
                            <div class="col-lg-8">
                                <div class="exam-icon"><i class="bi bi-stopwatch"></i></div><span
                                    class="badge text-bg-light border mt-3">30 phút · 20 câu ngẫu nhiên</span>
                                <h2 class="mt-3">Chế độ Thi thử PHP Developer</h2>
                                <p class="text-secondary lh-lg">Bài thi lấy câu hỏi ngẫu nhiên từ ngân hàng hiện tại,
                                    bao phủ PHP Core, Laravel, MySQL, Security và Performance.</p>
                                <div class="row g-2">
                                    <div class="col-4">
                                        <div class="feature"><span>Tổng câu</span><strong>20</strong></div>
                                    </div>
                                    <div class="col-4">
                                        <div class="feature"><span>Thời gian</span><strong>30 phút</strong></div>
                                    </div>
                                    <div class="col-4">
                                        <div class="feature"><span>Mục tiêu</span><strong>≥ 14/20</strong></div>
                                    </div>
                                </div><button class="btn btn-main mt-4" onclick="startExam()"><i
                                        class="bi bi-play-fill"></i> Bắt đầu thi ngay</button>
                            </div>
                            <div class="col-lg-4">
                                <div class="hero rounded-4 p-4">
                                    <div class="small text-white-50 text-uppercase fw-bold">Cấu trúc đề</div>
                                    <div id="structure" class="mt-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="examRun" class="d-none"></div>
                </div>
            </section>
            <section id="results" class="section d-none">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="cardx panel">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3>Lịch sử thi thử</h3>
                                    <div class="panel-sub">Lưu trong trình duyệt hiện tại</div>
                                </div><button class="btn btn-sm btn-outline-danger" onclick="clearResults()">Xóa lịch
                                    sử</button>
                            </div>
                            <div id="resultList" class="mt-3"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cardx panel">
                            <h3>Tổng quan</h3>
                            <div id="summary" class="mt-3"></div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="config" class="section d-none">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="cardx panel">
                            <h3>Cấu hình hệ thống</h3>
                            <div class="panel-sub mb-2">Thiết lập giao diện và bài thi phía client.</div>
                            <div class="config-row d-flex justify-content-between align-items-center">
                                <div><b class="small">Số câu mỗi trang</b>
                                    <div class="small text-secondary">Hiển thị trong ngân hàng</div>
                                </div><select id="pageSize" class="form-select" style="width:110px">
                                    <option>5</option>
                                    <option selected>10</option>
                                    <option>20</option>
                                </select>
                            </div>
                            <div class="config-row d-flex justify-content-between align-items-center">
                                <div><b class="small">Thời lượng thi</b>
                                    <div class="small text-secondary">Mặc định 30 phút</div>
                                </div><select id="duration" class="form-select" style="width:150px">
                                    <option value="900">15 phút</option>
                                    <option value="1800" selected>30 phút</option>
                                    <option value="2700">45 phút</option>
                                    <option value="3600">60 phút</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cardx panel">
                            <h3>Stack giao diện</h3>
                            <div class="small text-secondary mt-3">Bootstrap 5.3.3<br>Bootstrap Icons<br>CSS responsive
                                tùy biến<br>Vanilla JavaScript<br>PHP server-side data</div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    <div class="modal fade" id="modal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <div class="small text-white-50 mono" id="mid"></div>
                        <h5 class="modal-title" id="mtitle"></h5>
                    </div><button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="mbody"></div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const Q = <?php echo json_encode($questions, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>, C = <?php echo json_encode($categories, JSON_UNESCAPED_UNICODE); ?>; let pg = 1, ps = 10, timer = null, sec = 1800, examQ = [], ans = {}, history = JSON.parse(localStorage.getItem('phpInterviewResults') || '[]'); const $ = s => document.querySelector(s), $$ = s => document.querySelectorAll(s), titles = { dashboard: 'Dashboard tổng quan', questions: 'Ngân hàng câu hỏi', exam: 'Đề thi & Thi thử', results: 'Kết quả & Lịch sử', config: 'Cấu hình hệ thống' }; function esc(v) { let d = document.createElement('div'); d.textContent = v ?? ''; return d.innerHTML } function dc(d) { return d === 'Junior' ? 'junior' : d === 'Middle' ? 'middle' : 'senior' } function go(n) { $$('.section').forEach(x => x.classList.add('d-none')); $('#' + n).classList.remove('d-none'); $('#title').textContent = titles[n]; $$('.nav-btn').forEach(x => x.classList.toggle('active', x.dataset.page === n)); $('#sidebar').classList.remove('show'); if (n === 'questions') renderQ(); if (n === 'results') renderResults(); if (n === 'exam') setupExam() } $$('.nav-btn').forEach(x => x.onclick = () => go(x.dataset.page)); $('#toggle').onclick = () => $('#sidebar').classList.toggle('show'); function stats() { let a = [['Tổng câu hỏi', Q.length, 'Mục tiêu 100 câu', 'bi-book', 'g1'], ['Danh mục', new Set(Q.map(q => q.category)).size, 'PHP, Laravel, DB, Sec, OOP', 'bi-layers', 'g2'], ['Cấp độ', new Set(Q.map(q => q.difficulty)).size, 'Junior → Senior', 'bi-bullseye', 'g3'], ['Loại câu hỏi', new Set(Q.map(q => q.type)).size, 'Trắc nghiệm, Tình huống, Code', 'bi-file-earmark-text', 'g4']]; $('#stats').innerHTML = a.map((x, i) => `<div class="col-6 col-lg-3"><div class="cardx stat"><div class="d-flex justify-content-between"><div><div class="stat-label">${x[0]}</div><div class="stat-value">${x[1]}${i ? '' : '<small class="fs-6 text-secondary">/100</small>'}</div><div class="stat-sub">${x[2]}</div></div><div class="ico ${x[4]}"><i class="bi ${x[3]}"></i></div></div>${i ? '' : `<div class="progress mt-3"><div class="progress-bar" style="width:${Math.min(Q.length, 100)}%"></div></div>`}</div></div>`).join('') } function dashboard() { let counts = {}; C.forEach(c => counts[c] = Q.filter(q => q.category === c).length); $('#catTotal').textContent = Q.length + ' câu'; $('#cats').innerHTML = C.map(c => { let n = counts[c], p = Math.round(n / Q.length * 100); return `<div class="cat"><div class="cat-name"><i class="bi bi-folder2-open text-primary me-1"></i>${esc(c)}</div><div class="cat-bar"><div class="cat-fill" style="width:${p}%"></div></div><div class="text-end small"><b>${n}</b> <span class="text-secondary">(${p}%)</span></div></div>` }).join(''); $('#levels').innerHTML = ['Junior', 'Middle', 'Senior'].map(d => `<div class="col-4"><div class="mini"><strong>${Math.round(Q.filter(q => q.difficulty === d).length / Q.length * 100)}%</strong><span>${d}</span></div></div>`).join(''); $('#recent').innerHTML = Q.slice(0, 5).map(q => `<div class="qitem d-flex gap-3"><span class="qid py-3">${esc(q.id)}</span><div class="flex-grow-1"><div class="qtitle text-truncate">${esc(q.question)}</div><span class="tag">${esc(q.category)}</span><span class="diff ${dc(q.difficulty)}">${esc(q.difficulty)}</span></div></div>`).join('') } function filtered() { let t = $('#search').value.toLowerCase().trim(), c = $('#cat').value, d = $('#diff').value, y = $('#type').value; return Q.filter(q => (!t || q.question.toLowerCase().includes(t) || q.id.toLowerCase().includes(t) || q.tags.join(' ').toLowerCase().includes(t)) && (!c || q.category === c) && (!d || q.difficulty === d) && (!y || q.type === y)) } function renderQ() { let a = filtered(), pages = Math.max(1, Math.ceil(a.length / ps)); pg = Math.min(pg, pages); let s = a.slice((pg - 1) * ps, pg * ps); $('#count').textContent = `Tìm thấy ${a.length} câu`; $('#rows').innerHTML = s.length ? s.map(q => `<tr><td><span class="qid">${esc(q.id)}</span></td><td><div class="table-question">${esc(q.question)}</div>${q.tags.slice(0, 3).map(t => `<span class="tag">#${esc(t)}</span>`).join('')}<span class="tag text-primary">${esc(q.type)}</span><div class="d-lg-none small text-secondary mt-1">${esc(q.category)}</div></td><td class="d-none d-lg-table-cell"><span class="badge text-bg-light border">${esc(q.category)}</span></td><td><span class="diff ${dc(q.difficulty)}">${esc(q.difficulty)}</span></td><td><button class="btn btn-sm btn-light border" onclick="openQ('${q.id}')"><i class="bi bi-eye"></i></button></td></tr>`).join('') : `<tr><td colspan="5"><div class="empty">Không tìm thấy câu hỏi phù hợp.</div></td></tr>`; $('#pageInfo').textContent = `Trang ${pg}/${pages} · ${a.length} câu`; let st = Math.max(1, pg - 2), en = Math.min(pages, st + 4); if (en - st < 4) st = Math.max(1, en - 4); $('#pagination').innerHTML = `<li class="page-item ${pg === 1 ? 'disabled' : ''}"><button class="page-link" onclick="pg--;renderQ()">‹</button></li>` + Array.from({ length: en - st + 1 }, (_, i) => st + i).map(p => `<li class="page-item ${p === pg ? 'active' : ''}"><button class="page-link" onclick="pg=${p};renderQ()">${p}</button></li>`).join('') + `<li class="page-item ${pg === pages ? 'disabled' : ''}"><button class="page-link" onclick="pg++;renderQ()">›</button></li>` } ['search', 'cat', 'diff', 'type'].forEach(id => $('#' + id).addEventListener('input', () => { pg = 1; renderQ() })); function resetFilter() { $('#search').value = ''; $('#cat').value = ''; $('#diff').value = ''; $('#type').value = ''; pg = 1; renderQ() } function openQ(id) { let q = Q.find(x => x.id === id); $('#mid').textContent = q.id + ' · ' + q.category; $('#mtitle').textContent = q.question; $('#mbody').innerHTML = `<div class="mb-3"><span class="diff ${dc(q.difficulty)}">${esc(q.difficulty)}</span> <span class="tag">${esc(q.type)}</span>${q.tags.map(t => `<span class="tag">#${esc(t)}</span>`).join('')}</div><h6 class="fw-bold">Đáp án</h6>${q.options.map(o => `<div class="answer ${o.label === q.correct ? 'correct' : ''}"><b>${o.label}.</b> ${esc(o.text)} ${o.label === q.correct ? '<i class="bi bi-check-circle-fill text-success float-end"></i>' : ''}</div>`).join('')}<div class="alert alert-primary-subtle border-0 mt-4"><b>💡 Giải thích</b><div class="small mt-1">${esc(q.explanation)}</div></div>${q.scenario ? `<div class="alert alert-warning-subtle border-0"><b>Scenario</b><div class="small mt-1">${esc(q.scenario)}</div></div>` : ''}${q.codeSnippet ? `<h6 class="fw-bold mt-4">Code snippet</h6><div class="code">${esc(q.codeSnippet)}</div>` : ''}`; new bootstrap.Modal('#modal').show() } function setupExam() { if (timer) return; $('#examSetup').classList.remove('d-none'); $('#examRun').classList.add('d-none'); $('#structure').innerHTML = C.map(c => `<div class="d-flex justify-content-between small py-1"><span class="text-white-50">${esc(c)}</span><b>${Math.max(1, Math.round(Q.filter(q => q.category === c).length / Q.length * 20))}</b></div>`).join('') } function fmt(s) { return String(Math.floor(s / 60)).padStart(2, '0') + ':' + String(s % 60).padStart(2, '0') } function startExam() { examQ = [...Q].sort(() => Math.random() - .5).slice(0, Math.min(20, Q.length)); ans = {}; sec = Number($('#duration')?.value || 1800); clearInterval(timer); go('exam'); $('#examSetup').classList.add('d-none'); $('#examRun').classList.remove('d-none'); drawExam(); timer = setInterval(() => { sec--; if (sec <= 0) { finish(true) } else $('#timer').textContent = fmt(sec) }, 1000) } function drawExam() { let done = Object.keys(ans).length; $('#examRun').innerHTML = `<div class="exam p-0"><div class="d-flex justify-content-between border-bottom pb-3 mb-4"><div class="small text-secondary">Đã trả lời ${done}/${examQ.length} câu</div><b class="badge bg-dark fs-6" id="timer">${fmt(sec)}</b></div>${examQ.map((q, i) => `<div class="mb-4 pb-3 border-bottom"><div class="small text-secondary mb-2">Câu ${i + 1} · ${esc(q.category)} · ${esc(q.difficulty)}</div><div class="fw-bold mb-3">${esc(q.question)}</div>${q.options.map(o => `<label class="answer d-flex gap-2"><input type="radio" name="${q.id}" ${ans[q.id] === o.label ? 'checked' : ''} onchange="ans['${q.id}']='${o.label}';drawExam()"><span><b>${o.label}.</b> ${esc(o.text)}</span></label>`).join('')}</div>`).join('')}<button class="btn btn-main" onclick="finish(false)">Nộp bài</button></div>` } function finish(auto) { clearInterval(timer); timer = null; let score = examQ.reduce((n, q) => n + (ans[q.id] === q.correct), 0); history.unshift({ score, total: examQ.length, date: new Date().toLocaleString('vi-VN'), auto }); localStorage.setItem('phpInterviewResults', JSON.stringify(history.slice(0, 20))); $('#examRun').innerHTML = `<div class="text-center py-5"><div class="score mx-auto mb-3">${score}/${examQ.length}</div><h2 class="fw-bold">${score >= 14 ? 'Chúc mừng!' : 'Cần luyện thêm!'}</h2><p class="text-secondary">Đúng ${score}/${examQ.length} câu.</p><button class="btn btn-main me-2" onclick="startExam()">Thi lại</button><button class="btn btn-light border" onclick="go('results')">Xem kết quả</button></div>` } function renderResults() { let n = history.length, avg = n ? Math.round(history.reduce((s, r) => s + r.score / r.total * 100, 0) / n) : 0, best = n ? Math.max(...history.map(r => r.score)) : 0; $('#summary').innerHTML = `<div class="row g-2"><div class="col-4"><div class="feature"><span>Lần thi</span><strong>${n}</strong></div></div><div class="col-4"><div class="feature"><span>TB</span><strong>${avg}%</strong></div></div><div class="col-4"><div class="feature"><span>Cao nhất</span><strong>${best}</strong></div></div></div>`; $('#resultList').innerHTML = n ? history.map(r => `<div class="d-flex align-items-center gap-3 border rounded-3 p-3 mb-2"><div class="score" style="width:58px;height:58px;font-size:16px">${r.score}/${r.total}</div><div class="flex-grow-1"><b class="small">${r.score >= 14 ? 'Đạt mục tiêu' : 'Chưa đạt mục tiêu'}</b><div class="small text-secondary">${esc(r.date)}${r.auto ? ' · Hết giờ' : ''}</div></div><span class="badge ${r.score >= 14 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger'}">${Math.round(r.score / r.total * 100)}%</span></div>`).join('') : '<div class="empty">Chưa có lịch sử thi thử.</div>' } function clearResults() { if (confirm('Xóa toàn bộ lịch sử thi thử?')) { history = []; localStorage.removeItem('phpInterviewResults'); renderResults() } } $('#pageSize').onchange = e => { ps = +e.target.value; pg = 1; renderQ() }; stats(); dashboard(); renderQ(); setupExam();
    </script>
</body>

</html>