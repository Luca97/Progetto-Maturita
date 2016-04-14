using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Diagnostics;
using System.Drawing;
using System.Globalization;
using System.Linq;
using System.Text;
using System.Threading;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Progetto
{

   


    public partial class Benvenuto : Form
    {
        public Benvenuto()
        {
            InitializeComponent();
        }

        public object Integer { get; private set; }

        private void Benvenuto_Load(object sender, EventArgs e)
        {
           /* Accesso form = new Accesso();
            form.Show();
            Hide();
            */
        }
        private void label2_Click(object sender, EventArgs e)
        {
        }
        private void label1_Click(object sender, EventArgs e)
        {
            /*
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
                    Thread.Sleep(100);
                }


            }
            catch(Exception ex)
            {
                MessageBox.Show(ex.Message);
            }

                 */

            Accesso form = new Accesso();
            form.Show();
            this.Hide();
           // this.Close();
        }
    }
}
