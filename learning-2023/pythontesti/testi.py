
import psutil;

class Main:
    def __init__(self) -> None:
        # 1. Initialize
        print("Program starting...");

        # 2. Operate
        print("Cores: {}".format(psutil.cpu_count()));

        # 3. Cleanup
        print("Program ending...");
        return None;

if __name__ == "__main__":
    app = Main();
