using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

using System.Diagnostics;
using System.Collections;
using Microsoft.VisualBasic;
using System.Runtime.InteropServices;
using System.Globalization;
using System.IO;



namespace Progetto
{
    
    public partial class Recorder : Form
    {

        Timer timer;
        List<Nota> listaNote;
        private string outputAubionotes;
        Stopwatch stopwach = new Stopwatch();

        public Recorder()
        {
            InitializeComponent();
            timer = new Timer(); //INIZIALIZZO IL TIMER!
           
        }

        private void Recorder_BackButton_Click(object sender, EventArgs e)
        {
            Menu form = new Menu();
            form.Show();
            this.Hide();
        }

        [DllImport("winmm.dll", EntryPoint = "mciSendStringA", ExactSpelling = true, CharSet = CharSet.Ansi, SetLastError = true)]
        private static extern int record(string lpstrCommand, string lpstrReturnString, int uReturnLength, int hwndCallback);


        private void Recorder_RecButton_Click(object sender, EventArgs e)
        {
            timer.Enabled = true;
            timer.Start();
            record("open new Type waveaudio Alias recsound", "", 0, 0);
            record("record recsound", "", 0, 0);

            stopwach.Start();
            label1.Text = "Registrazione";
            label1.ForeColor = Color.Red;
        }

        private void Recorder_StopButton_Click(object sender, EventArgs e)
        {
            //Fine registrazione
            timer.Stop();
            timer.Enabled = false;
            string cmd = "save recsound PROVAREC.wav";
            record(cmd, "", 0, 0);
            record("close recsound", "", 0, 0);
            
            //ESEGUO AUBIONOTES.EXE -i nomeFile.wav e ne tengo l'output nella variabile "outputAubionotes":
            eseguiAubionotes();

            //OPERO SULL'OUTPUT DI AUBIONOTES, splittando le righe per ottenere le singole note(messe in una lista):
            listaNote = new List<Nota>();
            leggiDaFile();

            //ORA DEVO LAVORARE SULLE SINGOLE NOTE E SCRIVERE IL FILE .XML:
                //STEP DURATA:
                    int BPM = Int32.Parse(textBox_BPM.Text);
                    stepDurata(BPM);
            
                //STEP NOME NOTA:
                     stepNomeNota();

            //PARSER_XML:
            assegnaStringaXML();
            parsing();


            stopwach.Stop();
            label1.ForeColor = Color.Black;
            label1.Text = stopwach.Elapsed.ToString();


        }//end metodo bottone stop

        private void eseguiAubionotes()
        {
            try
            {
                var psi = new ProcessStartInfo
                {
                    FileName = @"aubionotes.exe",
                    Arguments = "-i DiesisHoldTheLineTest.wav",
                    RedirectStandardOutput = true,
                    UseShellExecute = false
                };
                var process = Process.Start(psi);
                while (!process.HasExited)
                {
                    System.Threading.Thread.Sleep(100);
                }

                outputAubionotes = process.StandardOutput.ReadToEnd();
            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message);
            }
        }

        private void leggiDaFile()
        {

            String outputString = outputAubionotes;//leggo tutto il file
            string[] lineeArray = outputString.Split('\n'); //separo le righe

            for (int i = 0; i < lineeArray.Length - 1; i++) //ogni linea è una nota
            {
                string[] infoNota = lineeArray[i].Split('\t'); //separo i tab
                                                               //aubionotes se non riconosce nessuna nota all'inizio la prima riga la riempie solo con un tempo. 
                                                               //di conseguenza se la prima riga non ha 3 informazioni ma solo il tempo... 
                                                               //allora la ignoro
                                                               //altrimenti estraggo i 3 campi dal vettore e accodo le note alla lista note
                if (i == 0 && infoNota.Length < 3)
                {
                    //do nothing. salto al prossimo ciclo del for (riga successiva)
                }
                else
                {
                    //in questa riga c'è una nota, quindi estraggo e accodo:
                    float ID = float.Parse(infoNota[0], CultureInfo.InvariantCulture);
                    float start = float.Parse(infoNota[1], CultureInfo.InvariantCulture);
                    float end = float.Parse(infoNota[2], CultureInfo.InvariantCulture);

                    Nota newNota = new Nota(ID, start, end);
                    listaNote.Add(newNota);
                }

            }//end for

        }

        private void stepDurata(int BPM)
        {
            // se i bpm sono 60: 1 sec = 1 quarto
            //se i bpm sono 120: 1/2 sec = 1 quarto 
            //quindi, 1 quarto è 60/bpm:
            float durataQuarto = (float)60 / BPM;  //è la durata (sempre in secondi) di un quarto a questa velocità (BPM)
            float durataIntero = durataQuarto * 4;
            float durataMezzo = durataQuarto * 2;
            float durataOttavo = durataQuarto / 2;
            float durataSedicesimo = durataQuarto / 4;
            float durataTrentaduesimo = durataQuarto / 16;
            //ora che ho tutte le durate a questa velocità di bpm posso capire di che tipo è la nota che sto considerando
            //faccio quindi un for:
            for (int i = 0; i < listaNote.Count; i++) //per ogni nota.. 
            {
                string tipo = "";
                //calcolo durata:
                float durataNota = listaNote[i].end - listaNote[i].start;

            if (durataNota > durataMezzo && durataNota < durataIntero)// se sta tra 1/2 e un intero allora è intero.
            {
                tipo = "whole";
                listaNote[i].intDurata = 4.0f;
                listaNote[i].duration = 96;
            }
           else if (durataNota > durataQuarto && durataNota < durataMezzo)//se sta tra 1/4 e 1/2 allora è 1/2
            {
                    tipo = "half";
                    listaNote[i].intDurata = 2.0f;
                    listaNote[i].duration = 48;
                }
            else if (durataNota > durataOttavo && durataNota < durataQuarto)
            {
                    tipo = "quarter";
                    listaNote[i].intDurata = 1.0f;
                    listaNote[i].duration = 24;
                }
           else if (durataNota > durataSedicesimo && durataNota < durataOttavo)
            {
                tipo = "eighth";
                listaNote[i].intDurata = 0.5f;
                listaNote[i].duration = 12;
                }
           else if (durataNota > durataTrentaduesimo && durataNota < durataSedicesimo)
            {
                    tipo = "16th";
                    listaNote[i].intDurata = 0.25f;
                    listaNote[i].duration = 6;
                }
            else if (durataNota < durataTrentaduesimo)//se è piu piccola di 1/32 è 1/32 .
            {
                tipo = "32th";
                listaNote[i].intDurata = 0.125f;
                    listaNote[i].duration = 3;//sedicesimi sono come i 32mi
                }

            listaNote[i].durata = tipo;//Assegno alla nota la sua durata!

            }
        }

        private void stepNomeNota()
        {
            //riempio il vettore che mi servirà successivamente:
            string[] vettoreIdNote = new string[12];
            vettoreIdNote[0] = "C";
            vettoreIdNote[1] = "C#";//
            vettoreIdNote[2] = "D";
            vettoreIdNote[3] = "D#";//
            vettoreIdNote[4] = "E";
            vettoreIdNote[5] = "F";
            vettoreIdNote[6] = "F#";//
            vettoreIdNote[7] = "G";
            vettoreIdNote[8] = "G#";//
            vettoreIdNote[9] = "A";
            vettoreIdNote[10] = "A#";//
            vettoreIdNote[11] = "B";

            //RIEMPIO LA MATRICE TABELLA:
            //questa tabella http://www.midimountain.com/midi/midi_note_numbers.html
            int[,] matrice = new int[11, 12];
            int numero = 0;
            for (int i = 0; i < 11; i++) //scorro righe
                for (int j = 0; j < 12; j++)  //scorro colonne
                    matrice[i, j] = numero++;

            //SCORRO LA LISTA DELLE SINGOLE NOTE
            //CERCO LA RIGA E LA COLONNA RELATIVA ALL'ID DELLA NOTA PRESA IN CONSIDERAZIONE. 
            //la riga sarà il numero dell'ottava, e la colonna sarà il nome della nota (su scala inglese)
            for (int i = 0; i < listaNote.Count; i++)
            {
                int weight = 12; //colonne
                int height = 11; //righe
                int riga = 0, colonna = 0;
                bool trovato = false; //sentinella
                for (int y = 0; y < height; y++)
                {
                    if (trovato) break;
                    for (int x = 0; x < weight; x++)
                    {
                        if (matrice[y, x].Equals((int)listaNote[i].ID))
                        {
                            trovato = true;
                            riga = y;
                            listaNote[i].numOttava = riga.ToString();
                            colonna = x;
                            listaNote[i].nomeNota = vettoreIdNote[colonna];
                            break;
                        }
                    }
                }
            }//end for scorri note

        }

        private void assegnaStringaXML()
        {
            //riempio la stringa xml di ogni nota.
            for (int i = 0; i < listaNote.Count; i++)
                if(listaNote[i].nomeNota.Length==1) //nota non alterata
                listaNote[i].xmlString =
 "<note>\n <pitch> \n <step>" + listaNote[i].nomeNota + "</step>\n  <octave>"+ listaNote[i].numOttava+"</octave>\n  </pitch>\n <duration>"+listaNote[i].duration+"</duration>\n  <voice>1</voice>\n  <type>" + listaNote[i].durata + "</type>\n </note>";

                else if(listaNote[i].nomeNota.Length==2) //nota alterata
            listaNote[i].xmlString =
 "<note>\n <pitch> \n <step>" + listaNote[i].nomeNota.Substring(0,1) + "</step>\n <alter> 1 </alter>\n <octave>" + listaNote[i].numOttava + "</octave>\n  </pitch>\n <duration>" + listaNote[i].duration + "</duration>\n  <voice>1</voice>\n  <type>" + listaNote[i].durata + "</type>\n  <accidental>sharp</accidental>\n </note>";



        }

        private void parsing()
        {
            //calcolo numero battute:
            float sommaDurate = 0.0f;
            for (int i = 0; i < listaNote.Count; i++)
            {
                sommaDurate += listaNote[i].intDurata;
            }
            float numBattute = sommaDurate / 4.0f;
            if (sommaDurate % 4 != 0) numBattute++; //se c'è resto allora aggiungo una battuta (anche se poi non sarà riempita completamente). 



            string header, footer, headBar, footBar;
            StreamReader hd = new StreamReader("header.txt");
            header = hd.ReadToEnd();

            StreamReader ft = new StreamReader("footer.txt");
            footer = ft.ReadToEnd();

            StreamReader hb = new StreamReader("inizioBattuta.txt");
            headBar = hb.ReadToEnd();

            StreamReader fb = new StreamReader("fineBattuta.txt");
            footBar = fb.ReadToEnd();

            string outputTOTALE = "";
            outputTOTALE += header+"\n";

            int indexNote = 0;//indice scorrimento note.

            for (int battute = 0; battute < numBattute; battute++)
            {
                //inizio bar
                outputTOTALE += headBar+"\n";
                //stringa con tutte le note
                string note = "";

                
                float battiti = 0f;
                while (battiti < 4 && indexNote<listaNote.Count)
                {
                    //aggiungo la nota solo se la sua durata sommata a battiti non supera il 4.
                    //if(...)

                    note +=  listaNote[indexNote].xmlString+"\n";
                    battiti += listaNote[indexNote].intDurata;
                    indexNote++;

                }
                outputTOTALE += note;

                //finebar
                outputTOTALE += footBar;
            }
            outputTOTALE += footer;

            StreamWriter outputFile = new StreamWriter("prova.xml");
            outputFile.WriteLine(outputTOTALE);
            outputFile.Flush();

        }


    }//END CLASS RECORDER (form)

    public class Nota
    {
      public  float ID, start, end;
        public string nomeNota, durata, numOttava;//vengono assegnati dopo aver fatto le operazioni.
        public float intDurata;
        public int duration;

        public string xmlString;

        public Nota() { nomeNota = ""; durata = ""; numOttava = ""; intDurata = 0.0f; xmlString = ""; duration = 0; }
        public Nota(float ID, float start, float end)
        {
            this.ID = ID;
            this.start = start;
            this.end = end;
            nomeNota = ""; durata = ""; numOttava = ""; intDurata = 0.0f;
            xmlString = "";
            duration = 0;
        }

    }

    
  

}
