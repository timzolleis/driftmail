export type Project = {
    id: string;
    name: string;
    description: string;
    active: number;
    config: ProjectConfiguration

}

type ProjectConfiguration = {
    id: string;
    project_id: string;
    api_key: string;
    mail_host: string;
    mail_port: string;
    mail_user: string;
    mail_sending_address: string;
    mail_test_receiver?: string

}
