using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Progetto
{
    class Utente
    {
        string username;
        string password;
        string email;

        Utente()
        {
            username = "";
            password = "";
            email = "";
        }

        Utente(string usn, string psw, string eml)
        {
            this.email = eml;
            this.username = usn;
            this.password = psw;
        }

        public void setUsn(string usn)
        {
            username = usn;
        }

        public void setPsw(string psw)
        {
            password = psw;
        }

        public void setEml(string eml)
        {
            email = eml;
        }


        public string getUsn()
        {
            return username;
        }

        public string getPsw()
        {
            return password;
        }

        public string getEml()
        {
            return email;
        }

        



    }
}
