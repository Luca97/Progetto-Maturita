using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Net;
using System.IO;

namespace Progetto
{
    class BufferUtenti
    {
        Utente[] vettore = new Utente[1000];

        public BufferUtenti()
        {
            for (int i = 0; i < 10; i++)
            {
                vettore[i].setUsn("");
                vettore[i].setPsw("");
                vettore[i].setEml("");
            }
        }

        public Utente getUtente(int pos)
        {
            return vettore[pos];
        }

        void setUtente(int pos, string usn, string psw, string eml)
        {
            vettore[pos].setUsn(usn);
            vettore[pos].setPsw(psw);
            vettore[pos].setEml(eml);
        }

        void LeggiDaWeb()
        {
            int i=0;
            WebClient webClient = new WebClient();
            webClient.DownloadFile("http://zireael.altervista.org/utentiRegistrati.csv", @"C:\Users\Default\AppData\Local\Temp");

            string[] lines = System.IO.File.ReadAllLines(@"C:\Users\Default\AppData\Local\Temp\utentiRegistrati.csv");
            
            foreach (string s in lines)
            {
                string[] split = lines[i].Split(";".ToCharArray());
                setUtente(i, split[0], split[1], split[2]);
                i++;
            }
            
        }

        public Boolean CercaUtenteByUsn(string usn)
        {
            LeggiDaWeb();
            bool trovato = false;

            for (int i = 0; i < 1000; i++)
            {
                if (getUtente(i).getUsn() == usn)
                {
                    trovato = true;
                }
                else
                {
                    trovato = false;
                }
            }
        
             return trovato;   
        }

        public Boolean CercaUtenteByEml(string eml)
        {
            LeggiDaWeb();
            bool trovato = false;

            for (int i = 0; i < 1000; i++)
            {
                if (getUtente(i).getEml() == eml)
                {
                    trovato = true;
                }
                else
                {
                    trovato = false;
                }
            }

            return trovato;
        }



    }
}
